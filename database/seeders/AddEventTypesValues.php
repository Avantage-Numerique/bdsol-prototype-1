<?php

namespace Database\Seeders;

use Domain\Events\Models\Type;
use Illuminate\Database\Seeder;

class AddEventTypesValues extends Seeder
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
                'name' => 'Formation'
            ],[
                'name' => 'Projection'
            ],[
                'name' => 'Atelier'
            ],[
                'name' => 'Conférence',
            ],[
                'name' => 'Exposition'
            ],[
                'name' => 'Installation'
            ],[
                'name' => 'Lancement'
            ]
        ];

        foreach($types as $index => $type)
        {
            $current = Type::create($type);
        }
    }
}
