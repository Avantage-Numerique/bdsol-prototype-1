<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Organisations\Models\Type;

class AddOrganisationTypesValues extends Seeder
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
                'name' => 'Entreprise'
            ],[
                'name' => 'Communauté'
            ],[
                'name' => 'Centre de recherche'
            ],[
                'name' => 'Établissement d\'enseignement',
            ],[
                'name' => 'Organisme para-gouvernemental'
            ],[
                'name' => 'Organisme gouvernemental'
            ],[
                'name' => 'Ministère'
            ],
        ];

        foreach($types as $index => $type)
        {
            $current = Type::create($type);
        }
    }
}
