<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create
        $path = base_path('database/create.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        // Populate
        $path = base_path('database/populate.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        $this->command->info('Database seeded!');
    }
}
