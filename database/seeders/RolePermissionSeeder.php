<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create role
        $role = Role::create(['name' => 'superadmin']);
        //create permission list
        $permissions = [
            [
                'group_name'=> 'dashboard',
                'permissions' => [
                    'dashboard view'
                ]
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    'user list',
                    'user create',
                    'user show',
                    'user edit',
                    'user delete',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role list',
                    'role create',
                    'role show',
                    'role edit',
                    'role delete',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    'profile list',
                    'profile edit',
                ]
            ],

        ];
        $permissionRowLength = count($permissions);
        for($i=0; $i < $permissionRowLength; $i++){
            $groupName = $permissions[$i]['group_name'];
            for($j=0; $j < count($permissions[$i]['permissions']); $j++){
                Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $groupName
                ]);
            }
        }

        //assign permission to role
        $role->syncPermissions(Permission::all());

         //assign role to user
         $user = User::first();
         $user->assignRole($role);

    }
}
