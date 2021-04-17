<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AddPermissionsVersion1 extends Seeder
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

        //use default now.$guard = config('backpack.base.guard');

        //Roles
        /*Role::create(['name' => 'admin']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'organisation']);
        Role::create(['name' => 'owner']);
        Role::create(['name' => 'viewer']);*/

        //CRUD
        $list_id = Permission::create(['name' => $list]);
        $list_all_id = Permission::create(['name' => $list_all]);
        $create_id = Permission::create(['name' => $create]);
        $update_id = Permission::create(['name' => $update]);
        $delete_id = Permission::create(['name' => $delete]);

        //Publication flow
        $publish_id = Permission::create(['name' => $publish]);
        $unpublish_id = Permission::create(['name' => $unpublish]);
        $approuve_id = Permission::create(['name' => $approuve]);

        //community power.
        $flag_id = Permission::create(['name' => $flag]);
        $evaluate_id = Permission::create(['name' => $evaluate]);


        // pre build the structure for awesome Spatie function to seed persmissions.
        $permissionsByRole = [
            'admin' => [$list, $list_all, $create, $update, $delete, $publish, $unpublish, $approuve, $flag, $evaluate],
            'moderator' => [$list, $list_all, $update, $publish, $unpublish, $approuve, $flag, $evaluate],
            'organisation' => [$list, $update, $publish, $unpublish, $approuve, $flag, $evaluate],
            'owner' => [$list, $update, $publish, $unpublish, $approuve, $flag, $evaluate],
            'viewer' => [$flag, $evaluate]
        ];
        foreach ($permissionsByRole as $role => $permissions) {
            $last_role = Role::create(['name' => $role]);

            foreach ($permissions as $index => $permission) {
                $last_role->givePermissionTo($permission);
            }
        }


        /*foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::whereName($role)->first();

            \DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(fn ($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id
                    ])->toArray()
                );
        }*/
    }
}
