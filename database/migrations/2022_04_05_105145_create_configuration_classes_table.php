<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained()
                                          ->onUpdate('cascade')
                                          ->onDelete('cascade');

           $table->foreignId('anneeUniversitaire_id')->references('id')->on('annee_universitaires')
                                                            ->onUpdate('cascade')
                                                            ->onDelete('cascade');;

            $table->foreignId('typeStage_id')->references('id')->on('type_stages')
                                                ->onUpdate('cascade')
                                                ->onDelete('cascade');

            $table->foreignId('ficheDemande_id')->references('id')->on('fiche_demandes')
                                                ->onUpdate('cascade')
                                                ->onDelete('cascade');

            /*$table->foreignId('documents_id')->constrained()
                                                ->onUpdate('cascade')
                                                ->onDelete('cascade');*/
            //$table->json('fiches');

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
        Schema::dropIfExists('configuration_classes');
    }
}