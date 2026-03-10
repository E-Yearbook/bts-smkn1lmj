<?php

namespace App\Models;

// ini tinker debug
// $book = TableBook::create([
// 'name' => 'Bagaimana cara menjadi enstein',
// 'publisher' => 'Enstein itu saya',
// 'book_category_id' => $category->id,
// 'year_cover_id' => $year->id,
// 'user_id' => 15,
// ]);

use Illuminate\Database\Eloquent\Model;

class TableBook extends Model
{
    protected $table = 'table_books';

    protected $fillable = [
        'book_category_id',
        'year_cover_id',
        'user_id',
        'name',
        'publisher',
        'book_cover',
        'book_path',
    ];

    public function category() {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function yearCover() {
        return $this->belongsTo(YearCover::class, 'year_cover_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}