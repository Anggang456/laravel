<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin Role',
            'email' => 'admin@role.test',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignrole('admin');

        $user = User::create([
            'name' => 'User Role',
            'email' => 'user@role.test',
            'password' => bcrypt('12345678')
        ]);

        $user->assignrole('user');
    }
}
