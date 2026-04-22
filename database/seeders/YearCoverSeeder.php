<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearCoverSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($year = 2010; $year <= 2024; $year++) {
            $data[] = [
                'year'         => $year,
                'cover_path'   => 'covers/dummy-cover-' . $year . '.jpg',
                'youtube_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        DB::table('year_covers')->insert($data);
    }
}