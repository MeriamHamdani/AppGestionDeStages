<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_stages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date_debut_periode');
            $table->date('date_fin_periode');
            $table->string('fiche_demande');
            $table->date('date_debut_depo');
            $table->date('deadline_depot');
            $table->json('type_sujet');
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
        Schema::dropIfExists('type_stages');
    }
}