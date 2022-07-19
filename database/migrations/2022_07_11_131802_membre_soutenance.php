<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MembreSoutenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membres_soutenances', function (Blueprint $table) {

            $table->id();
            $table->foreignId('soutenance_id')->constrained();
            //$table->foreignId('enseignant_id')->constrained();
            $table->unsignedBigInteger('membre_id');
            $table->foreign('membre_id')->references('id')->on('enseignants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}