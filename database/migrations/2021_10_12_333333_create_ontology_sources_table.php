<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOntologySourcesTable extends Migration
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
        $this->createTable('sources', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('title');
            $table->string('value_expected');//like text, integer, img, etc.
            $table->string('url');
            $table->string('url_parent');

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
        $this->dropIfExistsTable('sources');
    }
}
