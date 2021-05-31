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
            $table->unsignedBigInteger('person_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->index(['model_id', 'model_type'], 'model_has_person_model_id_model_type_index');

            $table->foreign('person_id')
                ->references('id')
                ->on('persons')
                ->onDelete('cascade');

            $table->primary(['person_id', 'model_id', 'model_type'],
                'model_has_persons_person_model_type_primary');

            $table->unsignedBigInteger('entity_role_id')->nullable();
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
