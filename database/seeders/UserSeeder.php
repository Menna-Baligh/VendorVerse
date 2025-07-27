<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // use the User model to create a new user
        User::create([
            'name' => 'Admin1',
            'email' => 'Y6A9o@example.com',
            'password' => Hash::make('password1'),
            'phone_number' => '1234567890',
        ]);
        // using the query builder to create a new user
        DB::table('users')->insert([
            'name' => 'Admin2',
            'email' => 'MFkOo@example.com',
            'password' => Hash::make('password2'),
            'phone_number' => '0987654321',
        ]);
    }
}
