<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected $permissions = [
        /**
         * *********************************
         * User permissions
         * *********************************
         */

        [
            'name' => 'all-users',
            'display_name' => 'All users',
            'description' => 'A user can view list of all users'
        ],
        [
            'name' => 'create-user',
            'display_name' => 'Create a user',
            'description' => 'A user can create another user'
        ],
        [
            'name' => 'update-user',
            'display_name' => 'Update a user',
            'description' => 'A user can update another user'
        ],
        [
            'name' => 'delete-user',
            'display_name' => 'Delete a user',
            'description' => 'A user can delete another user'
        ],
        [
            'name' => 'update-user roles',
            'display_name' => 'Update a user roles',
            'description' => 'A user can update another user roles'
        ],

        /**
         * *********************************
         * Role permissions
         * *********************************
         */

        [
            'name' => 'all-roles',
            'display_name' => 'All roles',
            'description' => 'A user can view list of all roles'
        ],
        [
            'name' => 'update-role',
            'display_name' => 'Update a role',
            'description' => 'A user can update a role'
        ],
        [
            'name' => 'update-role permissions',
            'display_name' => 'Update role permissions',
            'description' => 'A user can update role permissions'
        ],

        /**
         * *********************************
         * Permission permissions
         * *********************************
         */

        [
            'name' => 'all-permissions',
            'display_name' => 'All permissions',
            'description' => 'A user can view list of all permissions'
        ],
        [
            'name' => 'update-permission',
            'display_name' => 'Update a permission',
            'description' => 'A user can update a permission'
        ],

        /**
         * *********************************
         * Post permissions
         * *********************************
         */

        [
            'name' => 'all-posts',
            'display_name' => 'All posts',
            'description' => 'A user can view list of all posts'
        ],
        [
            'name' => 'create-post',
            'display_name' => 'Create a post',
            'description' => 'A user can create a post'
        ],
        [
            'name' => 'edit-post',
            'display_name' => 'Edit a post',
            'description' => 'A user can edit a post'
        ],
        [
            'name' => 'delete-post',
            'display_name' => 'Delete a post',
            'description' => 'A user can delete a post'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->permissions as $permission) {
            Permission::create($permission);
        }
    }
}
