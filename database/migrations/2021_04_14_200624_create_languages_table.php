<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqldata')->create('languages', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug');
            $table->longtext('description')->nullable();
            //Niveaux
            //utilisations
            //

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
        Schema::connection('mysqldata')->dropIfExists('languages');
    }
}
