<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StageCahierStageForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->foreignId('cahier_stage_id')->nullable()->constrained();
        });
        Schema::table('cahier_stages', function (Blueprint $table) {
            $table->foreignId('stage_id')->constrained();
        });
    }

}
