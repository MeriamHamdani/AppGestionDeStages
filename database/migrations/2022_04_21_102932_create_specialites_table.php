<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departement_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('enseignant_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('annee_universitaire_id')->constrained();
            $table->string('code')->unique();
            $table->string('nom');
            $table->string('cycle'); //cycle remplace formation
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
        Schema::dropIfExists('specialites');
    }
}
