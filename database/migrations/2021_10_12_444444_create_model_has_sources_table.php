<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasSourcesTable extends Migration
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
        $this->createTable('model_has_sources', function (Blueprint $table) {

            $table->unsignedBigInteger('source_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->string('model_value')->default('');

            $table->index(['model_id', 'model_type'], 'model_has_source_model_id_model_type_index');

            $table->foreign('source_id')
                ->references('id')
                ->on('sources')
                ->onDelete('cascade');

            $table->primary(['source_id', 'model_id', 'model_type'],
                'model_has_sources_source_model_type_primary');
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
        $this->dropIfExistsTable('model_has_sources');
    }
}
