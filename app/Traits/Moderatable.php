<?php

namespace App\Traits;

use App\Notifications\ModerateableNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Moderation;
use App\Models\Objection;
use App\Models\Regulation;

trait Moderatable
{
    private ?string $message = null;
    private ?string $status = 'failed';
    private ?array $scanImageResult = null;


    /* *******************************************************************
    * RENVOIE LE NOMBRE DE COMMENTAIRE OU OBJECTION DEJA APPROUVES
    * ********************************************************************/
    private function getNbrAlreadyModerated(): int
    {
        if (get_class($this) === Objection::class) {
            return $this->auteur->objections()
                ->whereHas('moderation', fn($q) => $q->where('mention', 'approved'))
                ->count();
        }

        return $this->auteur->commentaires()
            ->whereHas('moderation', fn($q) => $q->where('mention', 'approved'))
            ->count();
    }

    /* **************************************************************
    *  VERIFIE L' EXISTANCE D' UN OU PLUSIEURS MOTS INTERTITS 
    * ***************************************************************/
    private function hasDeniedWords(Regulation $regulation): bool
    {
        if (!$regulation->denied_words) {
            return false;
        }

        $deniedWords = array_filter(array_map('trim', explode(',', strtolower($regulation->denied_words))));
        $texte = strtolower($this->texte);

        foreach ($deniedWords as $word) {
            if (preg_match('/\b' . preg_quote($word, '/') . '\b/', $texte)) {
                return true;
            }
        }

        return false;
    }


    /* ***********************************************************
    * RENVOIE LE TYPE DE CONTENU INTERDITE AVEC SEUIL CRITIQUE 
    * ***********************************************************/
    private function getDeniedTasksFounded($regulation, $dataResults)
    {
        $deniedTasks = [];

        // Seuils par catégorie et clé
        $thresholds = [
            'nudity.sexual_activity' => 0.10,
            'nudity.suggestive' => 0.40,
            'weapon.classes.knife' => 0.40,
            'weapon.classes.firearm' => 0.40,
            'alcohol' => 0.50,
            'medical_drugs' => 0.40,
            'recreational_drugs' => 0.40,
            'gore.prob' => 0.30,
            'skull.prob' => 0.30,
            'offensive.prob' => 0.50,
            'offensive.nazi' => 0.10,
            'offensive.confederate' => 0.10,
            'offensive.supremacist' => 0.10,
            'offensive.terrorist' => 0.10,
            'offensive.middle_finger' => 0.10,
            
        ];

        foreach ($dataResults as $data) {
            foreach ($thresholds as $key => $threshold) {
                // Parcours la clé avec la notation pointée
                $keys = explode('.', $key);
                $value = $data;

                foreach ($keys as $subkey) {
                    if (!isset($value[$subkey])) {
                        $value = null;
                        break;
                    }
                    $value = $value[$subkey];
                }

                // Si la valeur dépasse le seuil et que la clé est interdite selon la regulation
                if ($value !== null && $value > $threshold) {
                    if (in_array($key, explode(',', $regulation->denied_images))) {
                        $deniedTasks[] = $key; // ✅ doit être $key, PAS $keys
                    }
                }

            }
        }

        return $deniedTasks;
    }


    /* ********************************************************
    * ANALYSE LE FICHIER ENFIN DE DETECTER SON CONTENU 
    * ******************************************************/
    private function scanImageAnalyse(Regulation $regulation): array
    {
        $responses = [];

        $fails = false;

        $models = ['nudity-2.1','weapon','gore-2.0','offensive','alcohol','text','scam'];

        foreach ($this->fichiers ?? [] as $file) {
            $filePath = storage_path('app/public/' . $file->path);

            if (!file_exists($filePath)) {
                Log::warning("Image file not found for moderation: {$filePath}");
                continue;
            }

            try {
                $response = Http::asMultipart()->post(config('services.sightengine.api_url'), [
                    ['name' => 'media', 'contents' => fopen($filePath, 'r'), 'filename' => basename($filePath)],
                    ['name' => 'models', 'contents' => implode(',', $models)],
                    ['name' => 'api_user', 'contents' => config('services.sightengine.api_user')],
                    ['name' => 'api_secret', 'contents' => config('services.sightengine.api_secret')],
                ]);
                
                if ($response->failed()) {
                    Log::error('Erreur API de modération image', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                        'image' => $file->path,
                    ]);
                    // $responses[] = null;
                    //Echec d' analyse d' image
                    $fails = true;
                    break;
                } else {
                    $responses[] = $response->json();
                }
            } catch (\Throwable $e) {
                $fails = true;
                Log::error('Exception lors de la modération image : ' . $e->getMessage());
                break;
            }
        }

        // dd($this->getDeniedTasksFounded($regulation,$responses));

        return [
            'fails' => $fails,
            'data_results' => !$fails ? $this->getDeniedTasksFounded($regulation,$responses) : []
        ];
    }


    /* ************************************************************
    * VERIFIE LA PRESENCE DU CONTENU INTERDITE (TEXTE OU FICHIER) 
    * *************************************************************/
    private function hasDeniedContent(Regulation $regulation): bool
    {
        if($this->hasDeniedWords($regulation)) {
            return true;
        }
        else if ($this->fichiers()->exists() > 0 && $regulation->denied_images) {
            $this->scanImageResult = $this->scanImageAnalyse($regulation);
            if ($this->scanImageResult['fails']) {
                //Ici on suppose qu' il peut y avoir des images interdites meme si l' analyse a echoue 
                return true;
            } else {
                return count($this->scanImageResult['data_results']) > 0;
            }
        } else {
            return false;
        }
    }


    /* ************************************************************
    * RENVOIE LA DESCRIPTION SUR LE TYPE DE CONTENU A INTERDITE 
    * ************************************************************/
    private function describeTaskName(string $task): ?string
    {
        $map = [
            'nudity.suggestive' => 'Sexualite suggestive(partielle)',
            'nudity.sexual_activity' => 'Activite sexuelle explicite',
            // 'weapon' => 'Arme',
            'weapon.classes.firearm' => 'Arme à feu',
            'weapon.classes.knife' => 'Arme blanche',
            'alcohol.prob' => 'Alcool',
            // 'drugs' => 'Drogue',
            // 'medical_drugs' => 'Drogue médicamenteuse',
            // 'recreational_drugs' => 'Drogue récréative',
            'offensive.prob' => 'Contenu offensant',
            'offensive.nazi' => 'Symbole nazi',
            'offensive.confederate' => 'Drapeau sudiste américain',
            'offensive.supremacist' => 'Contenu suprémaciste',
            'offensive.terrorist' => 'Contenu terroriste',
            'offensive.middle_finger' => 'Geste obscène',
            'gore.prob' => 'Blessure',
            'skull.prob' => 'Crâne',
            // 'ai-generated.prob' => 'Image generee par L\' AI'
        ];

        return $map[$task] ?? null;
    }

    
    /* ********************************************************
    * APPLIQUE LA MODERATION SUR LE MODEL 
    * ******************************************************/
    private function authNotice(Regulation $regulation, ?Moderation $moderation): void
    {
        if (!$moderation) {
            if($this->fichiers()->exists()) {
                if($this->scanImageResult['fails']) {
                    $this->message = 'Commentaire n\'a pas pu etre modere et reste en attente de modération due a l\' echec survenu lors de l\'analyse de l\'image !';
                }
            }
        }
        else if (strtolower($moderation->mention) === 'approved') {
            $this->message = 'Votre commentaire a été approuvé !';
            $this->status = 'success';
        } elseif ($this->fichiers()->exists() && $this->scanImageResult && $this->scanImageResult['fails']) {
            $this->message = "Commentaire n\'a pas pu etre modere et reste en attente de modération due a l\' echec survenu lors de l\'analyse de l\'image !";
        } elseif ($this->fichiers()->exists() && $this->scanImageResult && !empty($this->scanImageResult['data_results'])) {
            $deniedDescriptions = array_map(
                fn($task) => $this->describeTaskName($task),
                $this->scanImageResult['data_results']
            );
            $deniedDescriptions = array_filter($deniedDescriptions);
            $this->message = 'Commentaire non approuve avec contenu interdit détecté (' . implode(', ', $deniedDescriptions) . ') !!!';
        } else {
            $this->message = 'Commentaire non approuve avec contenus implicites détectés, présence de mots interdits !!!';
        }

        $this->auteur->auteable->notify(new ModerateableNotification($this,$this->message,$this->status));
    }


    /* *******************************************************
     * APPLIQUE LA MODERATION SUR LE MODEL 
     * *******************************************************/
    public function moderate(?string $mention = null) {
        //Initialization de la moderation
        $moderation = null;
        
        if (!$mention) {

            //Instance regulation
            $regulation = Regulation::getOne(1);

            // En cas d' activation de moderation automatique
            if (strtolower($regulation->attempt_all_to_moderated) !== 'oui') {

                $hasDeniedContent = $this->hasDeniedContent($regulation);
                $shouldModerate = true;

                if (isset($this->fichiers) && count($this->fichiers) > 0) {
                    if ($this->scanImageResult && $this->scanImageResult['fails']) {
                        $shouldModerate = false;
                    }
                }

                if ($shouldModerate && strtolower($regulation->must_already_moderated) === 'oui') {
                    $shouldModerate = $this->getNbrAlreadyModerated() >= $regulation->nbr_already_moderated;
                }

                if ($shouldModerate) {
                    $moderation = $this->moderation()->save(new Moderation([
                        'mention' => $hasDeniedContent ? 'rejected' : 'approved',
                    ]));
                }

                // Envoie de notification en cas de moderation automatique(absence de la mention)
                $this->authNotice($regulation, $moderation);
            }
        } else {
            $moderation = $this->moderation()->save(new Moderation(['mention' => $mention]));
        } 
        
        return $moderation;
    }
}