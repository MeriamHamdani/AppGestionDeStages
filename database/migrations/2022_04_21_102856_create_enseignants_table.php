<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnseignantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('departement_id')->constrained();
            $table->foreignId('etablissement_id')->constrained();
            $table->foreignId('annee_universitaire_id')->constrained();
            $table->string('nom');
            $table->string('prenom');
            $table->string('numero_telephone');
            $table->string('email')->unique();
            $table->string('grade');
            $table->string('rib');
            $table->string('identifiant')->unique();
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
        Schema::dropIfExists('enseignants');
    }
}
