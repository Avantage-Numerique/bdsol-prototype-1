<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*

    Add the time lapse table foreign key to the project table to be able to refer to it
    V.P.R

*/

class AddTimeLapseToProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('projects', function (Blueprint $table) {

            $table->unsignedBigInteger('time_lapse_id')->nullable()->onDelete('set null');
            $table->foreign('time_lapse_id')
                ->references('id')
                ->on('project_time_lapse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            Schema::dropIfExists('time_lapse_id');
        });
    }
}
