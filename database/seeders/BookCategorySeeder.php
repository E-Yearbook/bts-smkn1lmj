<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Guru', 'Siswa', 'Lain-Lain'];

        foreach ($categories as $category) {
            BookCategory::updateOrCreate(
                ['name' => $category],
                ['name' => $category] 
            );
        }
    }
}
