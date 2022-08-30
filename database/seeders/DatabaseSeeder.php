<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Matheus Dias',
            'email' => 'mthdias@outlook.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123@Mudarr'),
            'remember_token' => Str::random(10),
        ]);
    }
}
