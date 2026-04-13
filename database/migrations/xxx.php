<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Role;
use App\Models\Ressource;
use App\Models\Categorie;

return new class extends Migration
{
    /**
     * Creer les instances ressources
     */
    private function createRessources(): void
    {
        $ressources = ['blog', 'contact', 'offre_travail', 'besoin', 'benevole', 'evenement', 'don', 'donateur'];

        foreach ($ressources as $ressource) {
            Ressource::create([
                'nom' => $ressource
            ]);
        }
    }

    /**
     * Creer les instances roles
     */
    private function createRoles(): void
    {
        $roles = ['admin', 'blogeur', 'auteur'];

        foreach ($roles as $role) {
            Role::create([
                'rolename' => $role
            ]);
        }
    }

    /**
     * Creer le premier utilisateur admin
     */
    private function createAdmin(): void
    {
        $user = User::create([
            'nom' => 'Banyanga',
            'prenom' => 'Stephane',
            'email' => 'staphanebanyanga@gmail.com',
            'username' => 'stephanebanyanga',
            'password' => Crypt::encryptString('stephanebanyanga'),
            'photo' => 'profils/steph_banyanga.jpg'
        ]);

        $role = Role::where('rolename', 'admin')->first();

        if ($role) {
            $user->roles()->attach($role->id);
        }
    }

    /**
     * Creer la categorie par defaut pour blog
     */
    private function createDefaultCategorie(): void
    {
        Categorie::create([
            'nom' => 'non classe'
        ]);
    }

    /**
     * Run the migrations
     */
    public function up(): void
    {
        $this->createRoles();
        $this->createAdmin();
        $this->createRessources();
        $this->createDefaultCategorie();
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        // Supprime les données insérées
        User::where('email', 'staphanebanyanga@gmail.com')->delete();
        Role::whereIn('rolename', ['admin', 'blogeur', 'auteur'])->delete();
        Ressource::whereIn('nom', ['blog', 'contact', 'offre_travail', 'besoin', 'benevole', 'evenement', 'don', 'donateur'])->delete();
        Categorie::where('nom', 'non classe')->delete();
    }
};