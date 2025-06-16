<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run():void
    {
        User::updateOrCreate(['id' => 1], [
            'id' => 1,
           'name' => 'Super Admin',
           'email' => 'superadmin@pihps.com',
           'password' => bcrypt('admin123'),
            'role' => 'super admin'
        ]);

        User::updateOrCreate(['id' => 2], [
            'id' => 2,
           'name' => 'Admin',
           'email' => 'admin@pihps.com',
           'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);
    }
}
