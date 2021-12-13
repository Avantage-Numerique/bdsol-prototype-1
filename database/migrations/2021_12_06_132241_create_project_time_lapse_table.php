<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
    Time Lapse assiciated to a project to define the amount of time needed to realise it.
*/
class CreateProjectTimeLapseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_time_lapse', function (Blueprint $table) {
            $table->id();
            $table->text('time_lapse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_time_lapse');
    }
}
