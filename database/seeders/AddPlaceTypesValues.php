<?php

namespace Database\Seeders;

use Domain\Places\Models\Type;
use Illuminate\Database\Seeder;

class AddPlaceTypesValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Salle de spectacle'
            ],[
                'name' => 'Cinéma'
            ],[
                'name' => 'Salle d\'exposition'
            ],[
                'name' => 'Fab lab'
            ],[
                'name' => 'Hub'
            ],[
                'name' => 'Bibliothèque'
            ],[
                'name' => 'Salle de conférences'
            ],[
                'name' => 'Espace coworking'
            ]
        ];

        foreach($types as $index => $type)
        {
            $current = Type::create($type);
        }
    }
}
