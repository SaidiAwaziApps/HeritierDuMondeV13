<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\Visiteur;
use App\Models\Commentaire;
use App\Models\Objection;
use App\Models\Auteur;
use App\Models\Message;
use App\Models\User;
use App\Models\Guest;
use App\Http\Controllers\Test\CommentaireController;
use App\Notifications\ModerateableNotification;

Route::get('/test-isadmin', function () {
    return 'Middleware isAdmin reconnu !';
})->middleware('isAdmin');

Route::prefix('test')->as('test.')->group(function() {

    // Migration des visiteurs vers les guests
    Route::get('/migrate-visiteurs', function() {
        foreach(Visiteur::all() as $item) {
            Guest::create([
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'nom' => $item->nom,
                'email' => $item->email,
                'photo' => $item->photo
            ]);
        }
        return response()->json(['status' => 'success']);
    })->name('migrate_visiteurs');

    // Test création de message
    Route::get('/message/register', function() {
        $message = Message::create([
            'expediteur_id' => 2,
            'texte' => 'Lorem ipsum dolor sit amet consectetur...',
            'auth_serial_code' => rand() * rand()
        ]);

        $message->destinateurs()->attach([$message->id, 2]);

        return response()->json(['message' => $message]);
    })->name('message_register');

    // Test CommentaireController
    Route::get('/commentaire/register', function() {
        return view('pages.admin.test.commentaire.register');
    })->name('commentaire_register');

    // Test notifications
    Route::get('/notification', function() {
        $user = \App\Models\User::first();

        $user->notify(
            new \App\Notifications\ModerateableNotification(
                'Test final',
                'success'
            )
        );

        return 'sent';
    })->name('notification_test');

    // Test ajout texte aux dons
    Route::get('/dons', function() {
        $textes= [
            'Depuis que j ai decouvert votre organisation...',
            'J ai decide de faire ce don car je veux soutenir...',
            'Je me souviens du moment ou j ai choisi de soutenir...'
        ];

        $dons = App\Models\Don::all();

        foreach ($dons as $i => $don) {
            $don->update(['texte' => $textes[$i] ?? $textes[0]]);
        }

        return response()->json(['status' => 'dons updated']);
    })->name('dons_test');

    Route::get('/pusher', function() { 
        echo gethostbyname('api-eu.pusher.com'); 
    });

});