<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPresidentJuryForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soutenances', function (Blueprint $table) {

            $table->unsignedBigInteger('president_id');
            $table->foreign('president_id')->references('id')->on('enseignants');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soutenances', function (Blueprint $table) {
            //
        });
    }
}