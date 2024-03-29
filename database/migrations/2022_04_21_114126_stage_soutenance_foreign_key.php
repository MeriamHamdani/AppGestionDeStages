<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StageSoutenanceForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->foreignId('soutenance_id')->nullable()->constrained()->nullOnDelete();
        });
        Schema::table('soutenances', function (Blueprint $table) {
            $table->foreignId('stage_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stage', function (Blueprint $table) {
            //
        });
    }
}
