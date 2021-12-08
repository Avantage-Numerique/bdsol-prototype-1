<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsIsInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_persons', function (Blueprint $table) {
            $entity = 'person';
            $table->unsignedBigInteger($entity.'_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            //$table->string('model_value')->default('');

            $table->index(['model_id', 'model_type'], 'model_has_'.$entity.'s_model_id_model_type_index');

            $table->foreign($entity.'_id')
                ->references('id')
                ->on($entity.'s')
                ->onDelete('cascade');

            $table->primary([$entity.'_id', 'model_id', 'model_type'],
                'model_has_'.$entity.'s_'.$entity.'_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_persons');
    }
}
