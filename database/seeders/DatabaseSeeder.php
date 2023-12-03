<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    $this->call(UniversitySeeder::class);
    //    $this->call(UserSeeder::class);
       $this->call([
        UniversitySeeder::class,
        UserSeeder::class,
    ]);
    }
}
