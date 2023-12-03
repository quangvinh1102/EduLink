<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('universities')->truncate();
        University::create([
            'name' => 'Đại Học Tài Nguyên và Môi Trường',
            'description' => 'Description of University 1',
            'avatar' => '', 
            'location' => '41A Phú Diễn',
        ]);

        University::create([
            'name' => 'Đại Học Công Nghiệp',
            'description' => 'Description of University 2',
            'avatar' => '',
            'location' => 'Đường 32',
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
