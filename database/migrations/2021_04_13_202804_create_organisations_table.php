<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqldata')->create('organisations', function (Blueprint $table) {
            $table->id();

            $table->id();
            $table->text('name');
            $table->string('slug');
            $table->text('legal_name');
            $table->longtext('description')->nullable();

            // Média
            $table->text('avatar')->nullable();
            $table->text('header_image')->nullable();//Peut-être trop tot pour un feature comme ça, mais c'est quand même basique.

            // Réseaux sociaux
            // Type organisation
            // contact method(s)
            // Identifiant (ISNI, etc)
            // Équipe(s)
            // Projet(s)
            // Communautés(s)
            // Équipement(s)
            // Événement(s)
            // Compétence(s)
            // Occupation(s)
            // Organisation(s)



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
        Schema::dropIfExists('organisations');
    }
}
