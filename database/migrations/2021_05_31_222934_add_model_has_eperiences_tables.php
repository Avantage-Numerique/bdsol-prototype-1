<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelHasEperiencesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_experiences', function (Blueprint $table) {

            $table->unsignedBigInteger('experience_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->string('model_value')->default('');

            $table->index(['model_id', 'model_type'], 'model_has_experiences_model_id_model_type_index');

            $table->foreign('experience_id')
                ->references('id')
                ->on('experiences')
                ->onDelete('cascade');

            $table->primary(['experience_id', 'model_id', 'model_type'],
                'model_has_experiences_experience_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_experiences');
    }
}
