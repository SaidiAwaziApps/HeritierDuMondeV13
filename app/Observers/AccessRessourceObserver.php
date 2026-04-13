<?php

namespace App\Observers;

use App\Models\AccessRessource;

class AccessRessourceObserver
{
    /**
     * Handle the AccessRessource "created" event.
     */
    public function created(AccessRessource $accessRessource): void
    {
        //
    }

    /**
     * Handle the AccessRessource "updated" event.
     */
    public function updated(AccessRessource $accessRessource): void
    {
        //
    }

    /**
     * Handle the AccessRessource "deleted" event.
     */
    public function deleted(AccessRessource $accessRessource): void
    {
        //
    }

    /**
     * Handle the AccessRessource "restored" event.
     */
    public function restored(AccessRessource $accessRessource): void
    {
        //
    }

    /**
     * Handle the AccessRessource "force deleted" event.
     */
    public function forceDeleted(AccessRessource $accessRessource): void
    {
        //
    }
}