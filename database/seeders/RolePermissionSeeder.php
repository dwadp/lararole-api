<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('name', 'Admin')->first();

        $editor = Role::where('name', 'Editor')->first();

        $writer = Role::where('name', 'Writer')->first();

        $admin->attachPermissions(Permission::all());

        $editor->attachPermissions(
            Permission::whereNotIn('name', ['create-post', 'delete-post'])->get()
        );

        $writer->attachPermissions(
            Permission::whereNotIn('name', ['edit-post', 'delete-post'])->get()
        );
    }
}
