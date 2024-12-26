<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            'name' => 'Nguyen Duc Kien',
            'email' => 'kienchom@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Hydro',
            'email' => 'kienchom1@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'StrwbryChsCake',
            'email' => 'kienchom3@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
