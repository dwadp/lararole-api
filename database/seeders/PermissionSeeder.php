<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'create-post',
            'display_name' => 'Create a post',
            'description' => 'A user can create a post'
        ]);

        Permission::create([
            'name' => 'edit-post',
            'display_name' => 'Edit a post',
            'description' => 'A user can edit a post'
        ]);

        Permission::create([
            'name' => 'delete-post',
            'display_name' => 'Delete a post',
            'description' => 'A user can delete a post'
        ]);

        Permission::create([
            'name' => 'detail-post',
            'display_name' => 'View post detail',
            'description' => 'A user can view post detail'
        ]);

        Permission::create([
            'name' => 'all-post',
            'display_name' => 'List all posts',
            'description' => 'A user can view list of posts'
        ]);
    }
}
