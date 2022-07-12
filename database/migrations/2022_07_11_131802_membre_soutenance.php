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
        Schema::create('membre_soutenances', function (Blueprint $table) {

           // $table->integer('membreJury_id')->unsigned();
        
            //$table->integer('soutenance_id')->unsigned();
            
            $table->foreignId('soutenance_id')->constrained();
            $table->foreignId('membre_jury_id')->constrained();
            
            //$table->foreign('soutenance_id')->references('id')->on('soutenances')->onDelete('cascade');
            
            //$table->foreign('membreJury_id')->references('id')->on('membre_juries')->onDelete('cascade');
        
            
        
        });//
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