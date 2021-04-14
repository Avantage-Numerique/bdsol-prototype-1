<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqldata')->create('experiences', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug');
            $table->longtext('description')->nullable();

            //Champ d'application ??
            //Spécificité ??

            // projets

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
        Schema::dropIfExists('experiences');
    }
}
