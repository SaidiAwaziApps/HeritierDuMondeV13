<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type');
            $table->string('attempt_all_to_moderated')->nullable();
            $table->string('must_already_moderated')->default('oui');
            $table->integer('nbr_already_moderated')->nullable();
            $table->string('denied_words')->nullable();
            $table->string('denied_images')->nullable();
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
        Schema::dropIfExists('regulations');
    }
}
