<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class add_persmissions_version1 extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $list = 'list';
        $list_all = 'list all';
        $create = 'create';
        $update = 'update';
        $delete = 'delete';
        $publish = 'publish';
        $unpublish = 'unpublish';
        $approuve = 'approuve';
        $flag = 'flag';
        $evaluate = 'evaluate';

        $guard = config('backpack.base.guard');

        //Roles
        Role::create(['name' => 'admin', 'guard_name' => $guard]);
        Role::create(['name' => 'moderator', 'guard_name' => $guard]);
        Role::create(['name' => 'organisation', 'guard_name' => $guard]);
        Role::create(['name' => 'owner', 'guard_name' => $guard]);
        Role::create(['name' => 'viewer', 'guard_name' => $guard]);

        //CRUD
        /*Permission::create(['name' => $list, 'guard_name' => $guard]);
        Permission::create(['name' => $list_all, 'guard_name' => $guard]);
        Permission::create(['name' => $create, 'guard_name' => $guard]);
        Permission::create(['name' => $update, 'guard_name' => $guard]);
        Permission::create(['name' => $delete, 'guard_name' => $guard]);

        //Publication flow
        Permission::create(['name' => $publish, 'guard_name' => $guard]);
        Permission::create(['name' => $unpublish, 'guard_name' => $guard]);
        Permission::create(['name' => $approuve, 'guard_name' => $guard]);

        //community power.
        Permission::create(['name' => $flag, 'guard_name' => $guard]);
        Permission::create(['name' => $evaluate, 'guard_name' => $guard]);*/


        // pre build the structure for awesome Spatie function to seed persmissions.
        $permissionsByRole = [
            'admin' => [$list, $list_all, $create, $update, $delete, $publish, $unpublish, $approuve, $flag, $evaluate],
            'moderator' => [$list, $list_all, $update, $publish, $unpublish, $approuve, $flag, $evaluate],
            'organisation' => [$list, $update, $publish, $unpublish, $approuve, $flag, $evaluate],
            'owner' => [$list, $update, $publish, $unpublish, $approuve, $flag, $evaluate],
            'viewer' => [$flag, $evaluate]
        ];

        //Create the function to
        $insertPermissions = fn ($role) => collect($permissionsByRole[$role])
            ->map(fn ($name) => \DB::table('permissions')->insertGetId(['name' => $name, 'guard_name' => $guard]))
            ->toArray();

        $permissionIdsByRole = [
            'admin' => $insertPermissions('admin'),
            'moderator' => $insertPermissions('moderator'),
            'organisation' => $insertPermissions('organisation'),
            'owner' => $insertPermissions('owner'),
            'viewer' => $insertPermissions('viewer')
        ];

        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::whereName($role)->first();

            \DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(fn ($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id
                    ])->toArray()
                );
        }
    }
}
