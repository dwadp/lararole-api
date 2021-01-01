<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@lararole.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin')
        ]);

        $role = Role::where('name', 'Admin')->first();

        $user->attachRole($role);
    }
}
