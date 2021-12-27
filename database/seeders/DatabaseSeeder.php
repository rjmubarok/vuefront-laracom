<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name' => 'Salah Uddin',
            'email' => 'bdrosan@gmail.com',
            'password' => Hash::make('password')
        ]);
        // \App\Models\User::factory(10)->create();
    }
}