<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'first_name' => 'Keshav',
            'last_name' => 'Sharma',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin@123'),
            'role' => User::$admin,
            'password_2' => 'Admin@123'
        ]);


    }
}
