<?php

namespace Database\Seeders;

use Domain\Medias\Models\Type;
use Illuminate\Database\Seeder;

class AddMediaTypesValues extends Seeder
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
                'name' => 'Bande-anonce'
            ],[
                'name' => 'Publicité'
            ],[
                'name' => 'Affiche'
            ],[
                'name' => 'Photographie',
            ],[
                'name' => 'Portrait'
            ],[
                'name' => 'Extrait'
            ],[
                'name' => 'Projet entier'
            ]
        ];

        foreach($types as $index => $type)
        {
            $current = Type::create($type);
        }
    }
}
