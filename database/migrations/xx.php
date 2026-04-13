<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { 
        // Table de jointure entre les tables users et roles
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('role_id')->constrained();
            $table->boolean('status')->default(true);
        });

        // Relation entre tables ressources , access_ressources & users 
        Schema::table('access_ressources', function (Blueprint $table) {
            $table->foreignId('ressource_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });

        // Relation entre dons & besoins & besoin_dons
        Schema::create('besoin_dons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('besoin_id')->constrained();
            $table->foreignId('don_id')->constrained();
            $table->boolean('status')->default(true);  
        });

        // Relation entre dons & donateur
        Schema::table('dons', function (Blueprint $table) {
            $table->foreignId('donateur_id')->constrained();
        });

        // Relation entre receptions , dons & user
        Schema::table('receptions', function (Blueprint $table) {
            $table->foreignId('don_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });

        // Relation articles,categories && auteurs
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('categorie_id')->constrained();
            $table->foreignId('auteur_id')->constrained();  
        });

        // Relation entre tables commentaires && auteurs ;
        Schema::table('commentaires', function (Blueprint $table) {
            $table->foreignId('auteur_id')->constrained();
        });

        // Relation entre tables objections && auteurs
        Schema::table('objections', function (Blueprint $table) {
            $table->foreignId('auteur_id')->constrained();  
        });

        // messages -> auteurs
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('expediteur_id')
                  ->references('id')
                  ->on('auteurs')
                  ->cascadeOnDelete();

            $table->foreign('destinateur_id')
                  ->references('id')
                  ->on('auteurs')
                  ->cascadeOnDelete();
        });

        // Relation entre table messages && auth_msg_destinations
        Schema::table('auth_msg_destinations', function (Blueprint $table) {
            $table->foreign('message_id')
                  ->references('id')
                  ->on('messages')
                  ->cascadeOnDelete();
                  
            $table->foreign('destinateur_id')
                  ->references('id')
                  ->on('auteurs')
                  ->cascadeOnDelete();      
        });

        // Relation entre table payment_settings && identite
        Schema::table('payment_settings', function (Blueprint $table) {
            $table->foreignId('identite_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer les tables créées et les clés étrangères
        Schema::table('payment_settings', function (Blueprint $table) {
            $table->dropForeign(['identite_id']);
        });

        Schema::table('auth_msg_destinations', function (Blueprint $table) {
            $table->dropForeign(['message_id']);
            $table->dropForeign(['destinateur_id']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['expediteur_id']);
            $table->dropForeign(['destinateur_id']);
        });

        Schema::table('objections', function (Blueprint $table) {
            $table->dropForeign(['auteur_id']);
        });

        Schema::table('commentaires', function (Blueprint $table) {
            $table->dropForeign(['auteur_id']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['categorie_id']);
            $table->dropForeign(['auteur_id']);
        });

        Schema::table('receptions', function (Blueprint $table) {
            $table->dropForeign(['don_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('dons', function (Blueprint $table) {
            $table->dropForeign(['donateur_id']);
        });

        Schema::dropIfExists('besoin_dons');
        Schema::table('access_ressources', function (Blueprint $table) {
            $table->dropForeign(['ressource_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('user_roles');
    }
};