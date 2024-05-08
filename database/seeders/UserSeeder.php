<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SuperAdmin = [
            'name' => 'SuperAdmin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make("SuperAdmin@#"),
            'created_by' => 1,
    ];

        $AdminUser = User::create($SuperAdmin);
        $AdminUser->assignRole('SuperAdmin');
    }
}
