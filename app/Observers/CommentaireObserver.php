<?php

namespace App\Observers;

use App\Models\Commentaire;
use App\Jobs\ModerateableJob;

class CommentaireObserver
{
    /**
     * Handle the Commentaire "created" event.
     */
    public function created(Commentaire $commentaire): void
    {
        // Exemple : dispatcher le job de modération si des images existent
        if (!empty($commentaire->images) && count($commentaire->images) > 0) {
            ModerateableJob::dispatch($commentaire, null);
        } else {
            $commentaire->moderate(null);
        }
    }

    /**
     * Handle the Commentaire "updated" event.
     */
    public function updated(Commentaire $commentaire): void
    {
        //
    }

    /**
     * Handle the Commentaire "deleted" event.
     */
    public function deleted(Commentaire $commentaire): void
    {
        //
    }

    /**
     * Handle the Commentaire "restored" event.
     */
    public function restored(Commentaire $commentaire): void
    {
        //
    }

    /**
     * Handle the Commentaire "force deleted" event.
     */
    public function forceDeleted(Commentaire $commentaire): void
    {
        //
    }
}