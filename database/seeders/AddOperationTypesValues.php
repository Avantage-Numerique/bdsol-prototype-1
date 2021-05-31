<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Equipments\Models\Operation;

class AddOperationTypesValues extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Mobile : opéré par un technicien'
            ],[
                'name' => 'Mobile : Auto opéré avec support technique'
            ],[
                'name' => 'Mobile : Auto opéré sans support technique'
            ],[
                'name' => 'Sur place : opéré par un technicien'
            ],[
                'name' => 'Sur place : Auto opéré avec support technique'
            ],[
                'name' => 'Sur place : Auto opéré sans support technique'
            ],
        ];

        foreach($types as $index => $type)
        {
            $current = Operation::create($type);
        }
    }
}
