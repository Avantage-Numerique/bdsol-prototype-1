<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Occupations\Models\Occupation;

class AddOccupationArtistique extends Seeder
{
    public function run()
    {
        //Ajouter le Observer Sluggable avant de seeder ça.
        $occupations = [
            ['name' => 'Musicien'],
            ['name' => 'Chanteur'],
            ['name' => 'Auteur'],
            ['name' => 'Écrivain'],
            ['name' => 'Producteur'],
            ['name' => 'Réalisateur'],
            ['name' => 'Chorégraphe'],
            ['name' => 'Artisan'],
            ['name' => 'Acteur'],
            ['name' => 'Comédien'],
            ['name' => 'Danseur'],
            ['name' => 'Artiste du cirque'],
            ['name' => 'Chefs d\'orchestre'],
            ['name' => 'Compositeur'],
            ['name' => 'Arrangeur'],
            ['name' => 'Éclairagiste'],
            ['name' => 'Technicien de scène'],
            ['name' => 'Technicien de son'],
            ['name' => 'Accessoiriste'],
            ['name' => 'Caméraman'],
            ['name' => 'Concepteur de décor'],
            ['name' => 'Directeur artistique'],
            ['name' => 'Directeur de la photographie'],
            ['name' => 'Directeur de prodution'],
            ['name' => 'Directeur musical'],
            ['name' => 'Directeur technique'],
            ['name' => 'Machiniste de plateur'],
            ['name' => 'Maquilleur'],
            ['name' => 'coiffeur'],
            ['name' => 'Maquilleur-coiffeur'],
            ['name' => 'Monteur de son'],
            ['name' => 'Narrateur'],
            ['name' => 'Opérateur de son'],
            ['name' => 'Producteur'],
            ['name' => 'Régisseur'],
            ['name' => 'Sonorisateur'],
            ['name' => 'Réalisateur'],
            ['name' => 'Monteur'],
            ['name' => 'Peintre-scénographe'],
            ['name' => 'Peintre'],
            ['name' => 'Sculteur'],
            ['name' => 'Dessinateur d\'animation'],
            ['name' => 'Ébéniste artisan'],
            ['name' => 'Joaillier'],
            ['name' => 'Photographe'],
            ['name' => 'Designer graphique'],
            ['name' => 'Conteur'],
            ['name' => 'Poète'],
            ['name' => 'Travailleur culturel'],
            ['name' => 'Concepteur-Intégrateur sonore']
        ];

        foreach($occupations as $index => $occupation) {
            $current = Occupation::create($occupation);
        }
    }
}
