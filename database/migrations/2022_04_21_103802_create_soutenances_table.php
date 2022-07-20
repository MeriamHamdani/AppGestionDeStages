<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoutenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soutenances', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('stage_id')->constrained();ajoutée dans une autre migration
            $table->foreignId('annee_universitaire_id')->constrained();
            $table->date('date');
            $table->string('salle');
            $table->string('start_time');
            $table->float('note')->nullable();
            $table->string('mention')->nullable();
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
        Schema::dropIfExists('soutenances');
    }
}