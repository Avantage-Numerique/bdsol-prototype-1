<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
*       Adding starting and ending timestamp of the project
*/

class AddColumnModelValueToModelHasPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('model_has_persons', 'model_value'))
        {
            Schema::table('model_has_persons', function (Blueprint $table) {
                $table->string('model_value')->default('');
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
        if (!Schema::hasColumn('model_has_persons', 'model_value'))
        {
            Schema::table('model_has_persons', function (Blueprint $table) {
                $table->dropColumn('model_value');
            });
        }
    }
}
