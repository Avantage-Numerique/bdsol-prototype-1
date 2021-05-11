<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();

            $table->text('name');
            $table->string('slug');
            $table->longtext('description')->nullable();
            $table->longtext('address')->nullable();

            // Média
            $table->text('logo')->nullable();
            $table->text('header_image')->nullable();//Peut-être trop tot pour un feature comme ça, mais c'est quand même basique.
            // Galerie de médias : images, vidéos, sons. associés à un folder ? ou autres.

            // Réseaux sociaux

            // Owner : utilisateur qu'il l'a ajouté.

            // Lieux(s) (places) structure hierarchique ?
            // Identifiant (ISNI, etc)
            // Expérience(s) -> voir notes
            // Équipe(s) -> peut contenir des Personnes organisations
            // Collaborateurs(s) -> peut contenir des Personnes organisations
            // Finalité(s)
            // Type de lieux(s)

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
        Schema::dropIfExists('places');
    }
}
