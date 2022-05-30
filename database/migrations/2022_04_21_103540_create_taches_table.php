<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cahier_stage_id')->constrained()->cascadeOnDelete();
            $table->string('titre')->nullable();
            $table->string('contenu')->nullable();
            $table->date('date');
            $table->integer('rang');
            $table->integer('semaine');
            $table->timestamps();
            //$table->timestamp('heure');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taches');
    }
}