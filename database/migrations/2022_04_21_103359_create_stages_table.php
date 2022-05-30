<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained()->cascadeOnDelete();
            /*$table->foreignId('cahier_stage_id')->nullable()->constrained();
            $table->foreignId('depot_memoire_id')->nullable()->constrained();
            $table->foreignId('soutenance_id')->nullable()->constrained();*/
            $table->foreignId('annee_universitaire_id')->constrained();
            $table->string('titre_sujet')->nullable();
            $table->string('type_sujet')->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_demande');
            $table->string('fiche_demande')->nullable();
            $table->string('fiche_assurance')->nullable();
            $table->string('fiche_2Dinars')->nullable();
            $table->integer('confirmation_encadrant')->nullable();
            $table->integer('confirmation_admin')->nullable();
            $table->integer('validation_encadrant')->nullable();
            $table->integer('validation_admin')->nullable();
            $table->foreignId('entreprise_id')->nullable()->nullOnDelete()->constrained();
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
        Schema::dropIfExists('stages');
    }
}
