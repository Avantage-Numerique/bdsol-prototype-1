<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasPropertiesTable extends Migration
{
    use \Mamarmite\Database\Traits\SecondaryDBTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->migration_connection = "secondary";
        $this->createTable('model_has_properties', function (Blueprint $table) {

            $table->unsignedBigInteger('property_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->string('model_value')->default('');

            $table->index(['model_id', 'model_type'], 'model_has_property_model_id_model_type_index');

            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');

            $table->primary(['property_id', 'model_id', 'model_type'],
                'model_has_properties_property_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->migration_connection = "secondary";
        $this->dropIfExistsTable('model_has_properties');
    }
}
