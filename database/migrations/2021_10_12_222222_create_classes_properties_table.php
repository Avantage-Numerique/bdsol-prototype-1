<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesPropertiesTable extends Migration
{

    use \Mamarmite\Database\Traits\SecondaryDBTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->migration_connection = "secondary";
        $this->createTable('properties', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('title');
            $table->longText('intro');

            $table->longText('description');
            $table->longText('uses');
            $table->text('restrictions');

            $table->boolean('is_required');

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
        $this->migration_connection = "secondary";
        $this->dropIfExistsTable('properties');
    }
}
