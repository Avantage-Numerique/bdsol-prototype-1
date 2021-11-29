<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddAdminOntologyOnlyPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manage_ontology = 'manage ontology';
        $manage_ontology_id = Permission::create(['name' => $manage_ontology]);

        $admin_role = Role::where('name','admin')->first();
        $admin_role->givePermissionTo($manage_ontology_id);
    }
}
