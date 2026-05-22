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
        Schema::create('identites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom')->nullable();
            $table->string('slogant')->nullable(); // peut-être "slogan" à corriger si voulu
            $table->text('description')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('adresse')->nullable();
            $table->float('adresse_coord_lat', 10, 6)->nullable(); // précision GPS
            $table->float('adresse_coord_long', 10, 6)->nullable(); // précision GPS
            $table->string('logo')->nullable();
            $table->boolean('status')->default(true); // booléen plutôt que string
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identites');
    }
};