<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{

    use \Mamarmite\Database\Traits\SecondaryDBTrait;

    protected $migration_connection = "secondary";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createTable('sources', function (Blueprint $table) {

            $table->unsignedBigInteger('id');
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
        $this->dropIfExistsTable('sources');
    }
}
