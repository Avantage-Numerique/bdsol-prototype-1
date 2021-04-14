<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqldata')->create('equipments', function (Blueprint $table) {
            $table->id();

            $table->text('name');
            $table->string('slug');
            $table->longtext('description')->nullable();

            $table->boolean(('available_for_rent'))->default(false);

            // Média
            $table->text('avatar')->nullable();
            $table->text('header_image')->nullable();//Peut-être trop tot pour un feature comme ça, mais c'est quand même basique.
            // Galerie de médias : images, vidéos, sons. associés à un folder ? ou autres.

            // Owner : utilisateur qu'il l'a ajouté.

            // Organisation(s) (places)
            // Identifiant (codebarre)
            // Événements(s) (associé, comme une formation).

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
        Schema::dropIfExists('equipments');
    }
}
