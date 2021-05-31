<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug');
            $table->longtext('description')->nullable();

            // Média
            $table->text('logo')->nullable();
            $table->text('header_image')->nullable();//Peut-être trop tot pour un feature comme ça, mais c'est quand même basique.
            // Galerie de médias : images, vidéos, sons. associés à un folder ? ou autres.

            // Réseaux sociaux

            // Owner : utilisateur qu'il l'a ajouté.

            // Événement(s)
            // Identifiant (ISNI, etc)
            // Expérience(s) -> voir notes
            // Équipe(s) -> peut contenir des Personnes organisations
            // Collaborateurs(s) -> peut contenir des Personnes organisations
            // Finalité(s)
            // Discipline(s)
            // Sources(s)
            // Apprentissage(s) // Compétence(s)
            // Budgets(s)
            // Équipement(s) ??

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
        Schema::dropIfExists('projects');
    }
}
