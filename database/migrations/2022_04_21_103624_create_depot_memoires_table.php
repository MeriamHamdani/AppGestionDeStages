<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepotMemoiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depot_memoires', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('stage_id')->constrained();ajoutée dans une autre migration
            $table->foreignId('annee_universitaire_id')->constrained();
            $table->string('titre');
            $table->date('date_depot');
            $table->string('fiche_tech')->nullable();
            $table->string('fiche_biblio')->nullable();
            $table->string('attestation')->nullable();
            $table->string('fiche_plagiat')->nullable();
            $table->string('memoire')->nullable();
            $table->boolean('validation_encadrant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depot_memoires');
    }
}
