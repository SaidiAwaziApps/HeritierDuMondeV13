<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

use App\Models\Identite;
use App\Models\User;
use App\Models\Role;
use App\Models\Ressource;
use App\Models\Categorie;

return new class extends Migration
{
    /**
     * Creer l'identite par defaut
     */
    private function createDefaultIdentite(): void
    {
        Identite::create([
            'nom' => 'Heritiers du Monde',
            'slogant' => 'Nous sommes les heritiers',
            'tel' => '+243 978 957 300',
            'email' => 'heritierdumonde@gmail.cd',
            'adresse' => 'Bukavu, Nguba 2',
            'description' => 'Le monde est devenu de plus en plus dangereux d\'y vivre, n\'hésitons pas à aider les plus faibles aussi longtemps que possible sans crainte ni regret. Ensemble nous sommes plus fort',
            'adresse_coord_lat' => 47.2817,
            'adresse_coord_long' => 8.45023,
            'logo' => 'logo/default_logo.png' 
        ]);
    }

    /**
     * Creer les instances ressources
     */
    private function createRessources(): void
    {
        $ressources = ['blog', 'contact', 'offre_service', 'offre_travail', 'besoin', 'benevole', 'evenement', 'don', 'donateur'];

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
            'password' => Hash::make('stephanebanyanga'),
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
        $this->createDefaultIdentite();
        $this->createRessources();
        $this->createRoles();
        $this->createAdmin();
        $this->createDefaultCategorie();
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        // Supprime les données insérées
        Identite::where('id', 1)->delete();
        User::where('email', 'staphanebanyanga@gmail.com')->delete();
        Role::whereIn('rolename', ['admin', 'blogeur', 'auteur'])->delete();
        Ressource::whereIn('nom', ['blog', 'contact', 'offre_service', 'offre_travail', 'besoin', 'benevole', 'evenement', 'don', 'donateur'])->delete();
        Categorie::where('nom', 'non classe')->delete();
    }
};