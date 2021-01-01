<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'display_name' => 'Administrator',
            'description' => 'An administrator can access everything'
        ]);

        Role::create([
            'name' => 'Editor',
            'display_name' => 'Editor',
            'description' => 'An editor can only edit a post'
        ]);

        Role::create([
            'name' => 'Writer',
            'display_name' => 'Writer',
            'description' => 'A writer can only write a post'
        ]);

        Role::create([
            'name' => 'User',
            'display_name' => 'Regular User',
            'description' => 'A regular user can only see posts'
        ]);
    }
}
