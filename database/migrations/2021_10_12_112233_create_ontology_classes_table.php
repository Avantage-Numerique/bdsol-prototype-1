<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOntologyClassesTable extends Migration
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
        $this->createTable('classes', function (Blueprint $table) {

            $table->unsignedBigInteger('id');
            $table->string('slug');
            $table->string('title');
            $table->longText('intro');
            $table->longText('description');
            $table->text('source');
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
        $this->dropIfExistsTable('classes');
    }
}
