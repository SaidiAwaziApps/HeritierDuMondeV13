<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sociauxes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Polymorphic relation
            $table->string('sociauxeable_type')->nullable();
            $table->foreignId('sociauxeable_id')->nullable(); // Utiliser integer ou foreignId selon besoin

            // Réseaux sociaux
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('google')->nullable();
            $table->text('whatsapp')->nullable(); // correction de "whatsap"
            $table->text('instagram')->nullable();

            // Statut actif ou non
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sociauxes');
    }
};