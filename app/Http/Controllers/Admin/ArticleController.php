<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Jobs\ModerateableJob;
use App\Services\ImageService;
use App\Services\FichierService;
use App\Services\AuteurService;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Regulation;
use App\Models\Commentaire;

class ArticleController extends Controller
{
    /* *************************************************************
     * PAGE ENREGISTREMENT (REGISTER)
     * *************************************************************/
    public function register_page()
    {
        $categories = Categorie::findByCatType('article');
        $regulation = Regulation::getOne(1);

        return view('pages.admin.blog.article.register', compact('categories', 'regulation'));
    }

    /* *************************************************************
     * PAGE DE MODIFICATION (UPDATE)
     * *************************************************************/
    public function update_page($id)
    {
        $article = Article::where('id', $id)->where('status', true)->firstOrFail();
        $categories = Categorie::where('status', true)->get();
        $regulation = Regulation::getOne(1);

        return view('pages.admin.blog.article.update', compact('article', 'categories', 'regulation'));
    }

    /* *************************************************************
     * PAGE LISTE DES ARTICLES
     * *************************************************************/
    public function list()
    {
        $articles = Article::where('status', true)->get();
        $regulation = Regulation::getOne(1);

        return view('pages.admin.blog.article.list', compact('articles', 'regulation'));
    }

    /* *************************************************************
     * PAGE DETAILS D'UN ARTICLE
     * *************************************************************/
    public function details($id)
    {
        $article = Article::where('id', $id)
            ->where('status', true)
            ->with(['commentaires' => function ($query) {
                $query->where('status', true)
                      ->with(['objections' => fn($q) => $q->where('status', true)]);
            }])
            ->firstOrFail();

        return view('pages.admin.blog.article.details', [
            'article' => $article,
            'regulation' => Regulation::getOne(1),
            'app_url' => config('app.url'),
            'storage_path_url' => config('app.storage_path_url')
        ]);
    }

    /* *************************************************************
     * RÉCUPÈRE LES COMMENTAIRES LIÉS À UN ARTICLE
     * *************************************************************/
    public function getComments($id)
    {
        $article = Article::where('id', $id)->where('status', true)->firstOrFail();
        $commentaires = $article->commentaires()->where('status', true)
            ->with(['objections' => fn($q) => $q->where('status', true)])
            ->get();

        return response()->json(['commentaires' => $commentaires]);
    }

    /* *************************************************************
     * AJOUT D'UN COMMENTAIRE À UN ARTICLE
     * *************************************************************/
    public function addComment($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'texte' => ['required'],
            'fichiers.*' => ['max:20480']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $article = Article::where('id', $id)->where('status', true)->firstOrFail();

        $commentaire = $article->commentaires()->save(new Commentaire([
            'auteur_id' => AuteurService::define($request)->id,
            'texte' => $request->texte
        ]));

        // Gestion des fichiers
        if ($request->hasFile('fichiers')) {
            FichierService::saveMany($request, $commentaire, 'commentaire');
            $commentaire->load('fichiers');
        }

        // Modération
        if ($commentaire->fichiers && count($commentaire->fichiers) > 0) {
            ModerateableJob::dispatch($commentaire, null);
        } else {
            $commentaire->moderate(null);
        }

        return response()->json(['commentaire' => $commentaire]);
    }

    /* *************************************************************
     * ENREGISTREMENT D'UN ARTICLE
     * *************************************************************/
    public function save(Request $request)
    {
        $request->validate([
            'titre' => ['required'],
            'contenu' => ['required'],
        ]);

        // Header image
        $header_image = $request->hasFile('header_image')
            ? Storage::disk('public')->put('blog', $request->header_image)
            : null;

        $article = Article::create([
            'header_image' => $header_image,
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'categorie_id' => $request->categorie_id,
            'auteur_id' => AuteurService::define($request)->id,
        ]);

        // Gestion des images dans le corps de l'article
        $this->handleImages($request, $article);

        return redirect()->route('admin.article.list');
    }

    /* *************************************************************
     * MODIFICATION D'UN ARTICLE
     * *************************************************************/
    public function update_handler($id, Request $request)
    {
        $request->validate([
            'titre' => ['required'],
            'contenu' => ['required'],
            'categorie_id' => ['required']
        ]);

        $article = Article::where('id', $id)->where('status', true)->firstOrFail();

        // Header image
        $header_image = $request->hasFile('header_image')
            ? Storage::disk('public')->put('blog', $request->header_image)
            : $article->header_image;

        $article->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'categorie_id' => $request->categorie_id,
            'header_image' => $header_image
        ]);

        // Gestion des images (ajout/suppression)
        $this->handleImages($request, $article);

        return redirect()->route('admin.article.list');
    }

    /* *************************************************************
     * SUPPRESSION (DESACTIVATION) D'UN ARTICLE
     * *************************************************************/
    public function delete_one($id)
    {
        $article = Article::where('id', $id)->where('status', true)->firstOrFail();
        $article->update(['status' => false]);

        return redirect()->route('article.list');
    }

    /* *************************************************************
     * GESTION DES IMAGES ET SUPPRESSION
     * *************************************************************/
    private function handleImages(Request $request, Article $article)
    {
        $imageService = new ImageService();

        // Ajout d'images
        if (($request->hasFile('images') && count($request->file('images')) > 0) ||
            (!empty($request->iframes) && count($request->iframes) > 0)) {
            $imageService->saveMany($request, $article, 'article');
        }

        // Suppression d'images ou vignettes
        if ((!empty($request->remove_uploads_id) && count($request->remove_uploads_id) > 0) ||
            (!empty($request->remove_vgns_id) && count($request->remove_vgns_id) > 0)) {
            $imageService->deleteMany($request, $article);
        }
    }
}