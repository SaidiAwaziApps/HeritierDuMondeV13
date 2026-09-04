<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ce fichier contient toutes les routes web de l'application. Pour
| plus de clarté, chaque module de routes est séparé dans un fichier.
|
*/

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Modules de routes
|--------------------------------------------------------------------------
|
| Chaque fichier gère un ensemble de routes pour une fonctionnalité.
|
*/

// Modules pour admin
$webAdminModules = [
    'test',
    'identite',
    'user',
    'access_ressource',
    'offre_emploie',
    'offre_service',
    'evenement',
    'benevole',
    'besoin',
    'donateur',
    'don',
    'reception',
    'categorie',
    'article',
    'dashboard',
    'questionnement',
    'commentaire',
    'objection',
    'regulation',
    'moderation',
    'contact',
    'message',
    'payment_setting',
    'share',
    'home',
];

// Modules pour visiteur (guest)
$webGuestModules = [
    'home'
];

// Parcourt ensemble modules destinees a admin
foreach ($webAdminModules as $module) {
    require __DIR__ . "/web/admin/{$module}.php";
}

// Parcourt ensemble modules destinees a visiteur (guest)
foreach ($webGuestModules as $module) {
    require __DIR__ . "/web/guest/{$module}.php";
}


require __DIR__ . "/web/global/share.php";

require __DIR__ . "/web/auth/authentication.php";