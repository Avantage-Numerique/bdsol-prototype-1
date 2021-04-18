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
        Schema::create('identifiants', function (Blueprint $table) {
            $table->id();

            $table->text('name');
            $table->string('slug');
            $table->longtext('description')->nullable();
            $table->text('base_url')->nullable();
            $table->text('connection_method')->nullable();

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
        Schema::dropIfExists('identifiants');
    }
}
