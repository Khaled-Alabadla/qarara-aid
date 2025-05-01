<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Khaled',
            'email' => 'k@gmail.com',
            'password' => Hash::make('password'),
            'identity_number' => '408120012',
            // 'role' => 'super_admin',
            'family_size' => 4,
            'phone' => '0599771410',
            'position' => 'رئيس البلدية',


        ]);
    }
}
