<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Aksamedia',
            'username' => 'admin',
            'phone' => '08123456789',
            'email' => 'admin@aksamedia.test',
            'password' => Hash::make('pastibisa'),
        ]);
    }
}
