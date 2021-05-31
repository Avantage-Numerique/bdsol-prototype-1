<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{

    public static $types = [ 'operation_types', 'place_types', 'organisation_types', 'event_types', 'media_types' ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(self::$types as $index => $table) {
            Schema::create($table, function (Blueprint $table) {
                $table->id();
                $table->text('name');
                $table->string('slug');
                $table->longtext('description')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach(self::$types as $index => $table) {
            Schema::dropIfExists($table);
        }
    }
}
