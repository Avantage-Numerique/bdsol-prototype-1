<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelHasFinalityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_finalities', function (Blueprint $table) {

            $table->unsignedBigInteger('finality_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->string('model_value')->default('');

            $table->index(['model_id', 'model_type'], 'model_has_finality_model_id_model_type_index');

            $table->foreign('finality_id')
                ->references('id')
                ->on('finalities')
                ->onDelete('cascade');

            $table->primary(['finality_id', 'model_id', 'model_type'],
                'model_has_finalities_finality_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_finalities');
    }
}
