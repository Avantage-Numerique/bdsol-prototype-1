<?php

namespace Database\Seeders;

use Domain\Entity\Models\Role;
use Illuminate\Database\Seeder;

class AddEntityRolesValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Directeur-rice général-e'
            ],[
                'name' => 'Chargé-e de projet'
            ],[
                'name' => 'Producteur-rice'
            ],[
                'name' => 'Réalisateur-rice',
            ],[
                'name' => 'Monteur-e'
            ],[
                'name' => 'Éclairagiste-e'
            ],[
                'name' => 'Infographiste'
            ],[
                'name' => 'Graphiste'
            ],[
                'name' => 'Programmeur-e'
            ],[
                'name' => 'Photographe'
            ]
        ];

        foreach($roles as $index => $role)
        {
            $current = Role::create($role);
        }
    }
}
