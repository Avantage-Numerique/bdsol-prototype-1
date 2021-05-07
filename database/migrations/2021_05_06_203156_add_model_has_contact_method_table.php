<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelHasContactMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_contact_methods', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_method_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->index(['model_id', 'model_type'], 'model_has_contact_methods_model_id_model_type_index');

            $table->foreign('contact_method_id')
                ->references('id')
                ->on('contact_methods')
                ->onDelete('cascade');

            $table->primary(['contact_method_id', 'model_id', 'model_type'],
                'model_has_contact_methods_contact_method_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('model_has_contact_methods');
    }
}
