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
        Schema::create('offre_emploies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->date('date_emission')->nullable();
            $table->string('domaine')->nullable();
            $table->string('organisme')->nullable();
            $table->text('object')->nullable();
            $table->string('lieu')->nullable();
            $table->string('document')->nullable();
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_emploies');
    }
};