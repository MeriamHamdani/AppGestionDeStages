<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnneeUniversitairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annee_universitaires', function (Blueprint $table) {
            $table->id();
            $table->string('annee')->unique();
            $table->string('lettre_affectation')->nullable();
            $table->string('fiche_encadrement')->nullable();
            $table->string('attrayant')->nullable();
            $table->string('grille_evaluation_licence')->nullable();
            $table->string('grille_evaluation_info')->nullable();
            $table->string('grille_evaluation_master')->nullable();
            $table->string('pv_individuel')->nullable();
            $table->string('pv_global')->nullable();
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
        Schema::dropIfExists('annee_universitaires');
    }
}
