<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $yearCoverIds    = DB::table('year_covers')->pluck('id')->toArray();
        $bookCategoryIds = DB::table('book_categories')->pluck('id')->toArray();
        $userIds         = DB::table('users')->pluck('id')->toArray();

        if (empty($yearCoverIds) || empty($bookCategoryIds) || empty($userIds)) {
            $this->command->warn('BookSeeder dilewati: jalankan UserSeeder, BookCategorySeeder, dan YearCoverSeeder terlebih dahulu.');
            return;
        }

        $books = [
            ['name' => 'Buku Tahunan Kenangan Bersama',         'publisher' => 'Penerbit Nusantara'],
            ['name' => 'Jejak Langkah Siswa Berprestasi',       'publisher' => 'Gramedia'],
            ['name' => 'Kenangan Masa Sekolah',                 'publisher' => 'Erlangga'],
            ['name' => 'Catatan Perjalanan Akademik',           'publisher' => 'Penerbit Andi'],
            ['name' => 'Inspirasi dari Ruang Kelas',            'publisher' => 'Mizan'],
            ['name' => 'Generasi Emas Bangsa',                  'publisher' => 'Balai Pustaka'],
            ['name' => 'Semangat Belajar Tanpa Batas',          'publisher' => 'Salemba Empat'],
            ['name' => 'Karya Nyata Para Pelajar',              'publisher' => 'Penerbit Diandra'],
            ['name' => 'Mimpi Besar Anak Bangsa',               'publisher' => 'Republika'],
            ['name' => 'Prestasi di Atas Segalanya',            'publisher' => 'Deepublish'],
            ['name' => 'Satu Dekade Penuh Warna',               'publisher' => 'Gramedia'],
            ['name' => 'Tumbuh Bersama Ilmu Pengetahuan',       'publisher' => 'Erlangga'],
            ['name' => 'Dari Bangku Sekolah ke Panggung Dunia', 'publisher' => 'Penerbit Andi'],
            ['name' => 'Memoar Sang Juara Kelas',               'publisher' => 'Mizan'],
            ['name' => 'Warna-Warni Kehidupan Pelajar',         'publisher' => 'Balai Pustaka'],
            ['name' => 'Jejak Tinta di Atas Kertas',            'publisher' => 'Penerbit Nusantara'],
            ['name' => 'Kisah Nyata Pejuang Nilai',             'publisher' => 'Republika'],
            ['name' => 'Langkah Pertama Menuju Sukses',         'publisher' => 'Deepublish'],
            ['name' => 'Bersatu dalam Keberagaman',             'publisher' => 'Salemba Empat'],
            ['name' => 'Cahaya Ilmu di Setiap Halaman',         'publisher' => 'Penerbit Diandra'],
        ];

        $data = [];

        foreach ($books as $index => $book) {
            $data[] = [
                'book_category_id' => $bookCategoryIds[array_rand($bookCategoryIds)],
                'year_cover_id'    => $yearCoverIds[$index % count($yearCoverIds)],
                'user_id'          => $userIds[array_rand($userIds)],
                'name'             => $book['name'],
                'publisher'        => $book['publisher'],
                'book_cover'       => 'book_covers/dummy-cover-' . ($index + 1) . '.jpg',
                'book_path'        => 'books/dummy-book-' . ($index + 1) . '.pdf',
                'created_at'       => now(),
                'updated_at'       => now(),
            ];
        }

        DB::table('books')->insert($data);
    }
}