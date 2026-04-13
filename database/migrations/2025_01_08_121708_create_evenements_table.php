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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->string('titre')->nullable();
            $table->date('date_du_jour')->nullable();
            $table->date('periode_date_debut')->nullable();
            $table->date('periode_date_fin')->nullable();
            $table->string('lieu')->nullable();
            $table->text('contenu')->nullable();
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};