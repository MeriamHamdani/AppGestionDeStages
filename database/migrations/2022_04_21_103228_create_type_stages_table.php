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
            $table->date('date_limite_periode');
            $table->string('fiche_demande');
            $table->date('date_debut_depot')->nullable();
            $table->date('date_limite_depot')->nullable();
            $table->json('type_sujet')->nullable();
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