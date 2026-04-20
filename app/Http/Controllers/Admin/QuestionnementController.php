<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\NavigationService;
use App\Models\Questionnement;
use App\Models\Identite;

class QuestionnementController extends Controller
{
    /* ***********************************************************
     * RENVOIE LA PAGE D' ENREGISTREMENT
     * ***********************************************************/
    public function register_page(): View {
        return view('pages.admin.questionnement.register');
    }

    /* ***********************************************************
     * RENVOIE LA PAGE DE MODIFICATION
     * ***********************************************************/
    public function update_page($id): View {
        // Instance a modifier
        $questionnement = Questionnement::where('id','=',$id)
                                        ->where('status','=',true)
                                        ->firstOrFail();

        // Return la page pour modification                              
        return view('pages.admin.questionnement.update',[
            'questionnement' => $questionnement
        ]);
    }

    /* ***********************************************************
     * RENVOIE LA PAGE LIST (INSTANCES) 
     * ***********************************************************/
    public function list(): View {
        return view('pages.admin.questionnement.list');
    }

    /* ***********************************************************
     * TRAITE L' ENREGISTREMENT (PROCESSUS)
     * ***********************************************************/
    public function save(Request $request): RedirectResponse {
        // Validation du formulaire
        $request->validate([
            'question' => ['required','string'],
            'reponse' => ['required','string'] 
        ]);

        // Verifie si la question a deja ete pose(questionnement avec la meme question)
        if(Questionnement::where('question','=',$request->question)
                         ->where('status','=',true)
                         ->exists()) {
            return redirect()->route('questionnement.register')
                             ->withErrors([
                                'reponse_existant' => 'La question "'.$request->question.'" a deja ete posee.'
                             ])
                             ->withInput();
        }

        // Recupere l'identite
        $identite = Identite::getOne(1);

        if($identite) {
            // Enregistre le questionnement
            $identite->questionnements()->save(new Questionnement([
                'question' => $request->question,
                'reponse'  => $request->reponse
            ]));
        }

        // Renvoie a la page de list
        return redirect()->route('questionnement.list');
    }

    /* ***********************************************************
     * TRAITE LA MODIFICATION D' UNE INSTANCE DANS LA B.D
     * ***********************************************************/
    public function update_handler($id, Request $request): RedirectResponse {
        // Validation du formulaire
        $request->validate([
            'question' => ['required','string'],
            'reponse' => ['required','string'] 
        ]);

        // Instance a modifier
        $questionnement = Questionnement::where('id','=',$id)
                                        ->where('status','=',true)
                                        ->firstOrFail();

        // Au cas il y'a modification de la question
        if($request->question != $questionnement->question) {
            // Questionnement avec cette question existant
            if(Questionnement::where('question','=',$request->question)
                             ->where('status','=',true)
                             ->exists()) {
                return redirect()->route('questionnement.update_page',['id'=>$id])
                                 ->withErrors([
                                    'reponse_existant'=>'La question "'.$request->question.'" a deja ete posee.'
                                 ])
                                 ->withInput();
            }
        }  

        // Execution de la modification
        $questionnement->update([
            'question' => $request->question,
            'reponse'  => $request->reponse
        ]);

        // Renvoie a la page list
        return redirect()->route('questionnement.list');                              
    }

    /* ***********************************************************
     * SUPPRIME (DESACTIVE) UNE INSTANCE DE LA B.D
     * ***********************************************************/
    public function delete_one($id): RedirectResponse {
        // Instance a supprimer
        $questionnement = Questionnement::where('id','=',$id)
                                        ->where('status','=',true)
                                        ->firstOrFail();

        // Execution de la suppression
        $questionnement->update([
            'status' => false
        ]);

        // En cas de l'existance des instances
        if(Questionnement::where('status','=',true)->exists()){
            return redirect()->route('questionnement.list');
        } 
        else {
            return redirect(NavigationService::getBackPageURL());
        }                              
    }
}