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
            $table->string('titre_sujet');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_demande');
            $table->integer('confirmation_encadrant');
            $table->integer('confirmation_admin');
            $table->integer('validation_encadrant');
            $table->integer('validation_admin');
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
