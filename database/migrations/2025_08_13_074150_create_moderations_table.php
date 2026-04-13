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
        Schema::create('moderations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Colonnes pour la relation polymorphique
            $table->string('moderateable_type');  // Type du modèle (ex. 'Post', 'Comment')
            $table->integer('moderateable_id');    // ID du modèle

            $table->string('mention')->default('attempt');
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderations');
    }
};