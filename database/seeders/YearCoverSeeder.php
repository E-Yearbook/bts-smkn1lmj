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
                'year'                  => $year,
                'cover_path'            => 'covers/dummy-cover-' . $year . '.jpg',
                'title_video_sambutan'  => 'Video Sambutan ' . $year,
                'youtube_link_sambutan' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'title_video_angkatan'  => 'Video Angkatan ' . $year,
                'youtube_link_angkatan' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'created_at'            => now(),
                'updated_at'            => now(),
            ];
        }

        DB::table('year_covers')->insert($data);
    }
}