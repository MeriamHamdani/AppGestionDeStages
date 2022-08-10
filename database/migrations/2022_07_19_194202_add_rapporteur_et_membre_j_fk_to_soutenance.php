<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRapporteurEtMembreJFkToSoutenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soutenances', function (Blueprint $table) {
            $table->unsignedBigInteger('rapporteur_id')->nullable();
            $table->foreign('rapporteur_id')->references('id')->on('enseignants')->nullOnDelete();;
            $table->unsignedBigInteger('deuxieme_membre_id')->nullable();
            $table->foreign('deuxieme_membre_id')->references('id')->on('enseignants')->nullOnDelete();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Soutenances', function (Blueprint $table) {
            //
        });
    }
}
