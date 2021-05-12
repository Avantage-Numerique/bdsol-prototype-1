<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasIdentifantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_identifiants', function (Blueprint $table) {

            $table->unsignedBigInteger('identifiant_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->string('model_value')->default('');

            $table->index(['model_id', 'model_type'], 'model_has_identifiants_model_id_model_type_index');

            $table->foreign('identifiant_id')
                ->references('id')
                ->on('identifiants')
                ->onDelete('cascade');

            $table->primary(['identifiant_id', 'model_id', 'model_type'],
                'model_has_identifiants_identifiant_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_identifants');
    }
}
