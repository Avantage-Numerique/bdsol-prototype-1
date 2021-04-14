<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentifiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqldata')->create('identifiants', function (Blueprint $table) {
            $table->id();

            $table->text('name');
            $table->string('slug');
            $table->longtext('description')->nullable();

            $table->text('target_name');
            $table->string('target_id');
            $table->text('target_slug');
            $table->string('target_complete_url');
            $table->string('target_complete_url');
            $table->text('target_value');

            $table->boolean(('is_syncable'))->default(false);

            //entities liés. Polymorphique ? pour personnes, org. projet, etc.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysqldata')->dropIfExists('identifiants');
    }
}
