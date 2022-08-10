<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StageDepotMemoireForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->foreignId('depot_memoire_id')->nullable()->constrained()->nullOnDelete();
        });
        Schema::table('depot_memoires', function (Blueprint $table) {
            $table->foreignId('stage_id')->constrained()->cascadeOnDelete();
        });
    }

}
