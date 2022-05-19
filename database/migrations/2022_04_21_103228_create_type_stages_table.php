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
            $table->string('fiche_demande')->nullable();
            $table->string('fiche_demande_type');
            $table->string('fiche_assurance_type');
            $table->string('fiche__type');
            $table->string('cahier_stage_type');
            $table->int('duree_stage_min');
            $table->int('duree_stage_max');
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
