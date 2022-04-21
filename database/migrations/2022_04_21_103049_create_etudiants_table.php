<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            //$table->foreignIdF('annee_universitaire_id')->constrained();
            $table->foreign('annee_universitaire_id')
          ->references('annee_universitaires')
          ->on('id')
          ->onDelete('cascade');
            $table->foreignId('classe_id')->constrained();
            $table->string('nom');
            $table->string('prenom');
            $table->string('numero_telephone');
            $table->string('email')->unique();
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
        Schema::dropIfExists('etudiants');
    }
}