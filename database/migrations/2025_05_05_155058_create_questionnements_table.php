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
        Schema::create('questionnements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('questionneable_type');
            $table->integer('questionneable_id');
            $table->text('question');
            $table->text('reponse');
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnements');
    }
};