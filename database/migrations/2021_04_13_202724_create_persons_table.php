<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysqldata')->create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->text('firstname');
            $table->text('lastname');
            $table->text('nickname')->nullable();
            $table->longtext('description')->nullable();

            // Géo
            $table->text('address')->nullable();

            // Média
            $table->text('logo')->nullable();
            $table->text('avatar')->nullable();
            $table->text('header_image')->nullable();//Peut-être trop tot pour un feature comme ça, mais c'est quand même basique.

            // Réseaux sociaux
            // Relational(s)
            // contact method(s)
            // citoyenneté
            // Langue(s) maîtrisé
            // Identifiant (ISNI, etc)
            // Compétence(s)
            // Occupation(s)
            // Projet(s)
            // Communautés(s)
            // Organisation(s)
            // Équipe(s)

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
        Schema::dropIfExists('persons');
    }
}
