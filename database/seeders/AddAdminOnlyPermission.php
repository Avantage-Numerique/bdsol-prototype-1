<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddAdminOnlyPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manage_users = 'manage users';
        $manage_users_id = Permission::create(['name' => $manage_users]);

        $admin_role = Role::where('name','admin')->first();
        $admin_role->givePermissionTo($manage_users);
    }
}
