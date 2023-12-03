<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('universities')->truncate();
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1'),
            'avatar' => 'storage/avatar/admin-default.png',
            'university_id' => 1,
            'role' => 1,
        ]);

        User::create([
            'name' => 'quang vinh',
            'email' => 'vinhls2002@gmail.com',
            'password' => Hash::make('1'),
            'avatar' => 'storage/avatar/admin-default.png',
            'university_id' => null,
            'role' => 0,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
