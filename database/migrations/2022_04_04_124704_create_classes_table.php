<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->integer('cycle');
			$table->integer('niveau');
            $table->string('code');
            $table->string('nom');
            /*$table->foreignId('specialite_id')->constrained()
                                              ->onUpdate('cascade')
                                              ->onDelete('cascade');*/

           /* $table->foreignId('configurationClasse_id')->constrained()
                                                        ->onUpdate('cascade')
                                                        ->onDelete('cascade');*/
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
        Schema::dropIfExists('classes');
    }
}