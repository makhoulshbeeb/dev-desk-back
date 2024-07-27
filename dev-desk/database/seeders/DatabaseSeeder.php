<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Calling the UserSeeder and ScriptSeeder
        $this->call([
            UserSeeder::class,
            ScriptSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class,
        ]);
    }
}
