<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Projects\Models\Finality;

class AddFinalitiesValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Ajouter le Observer Sluggable avant de seeder ça.
        $finalities = [
            ['name' => 'Application web'],
            ['name' => 'Cahier pédagogique'],
            ['name' => 'Livre'],
            ['name' => 'Exposition'],
            ['name' => 'Installation'],
            ['name' => 'Installation interactive'],
            ['name' => 'Jeu vidéo'],
            ['name' => 'Pièce de théâtre'],
            ['name' => 'Site web'],
            ['name' => 'Application mobile'],
            ['name' => 'Spectacle musical'],
            ['name' => 'Peinture']
        ];

        foreach($finalities as $index => $finalitiy) {
            $current = Finality::create($finalitiy);
        }
    }
}
