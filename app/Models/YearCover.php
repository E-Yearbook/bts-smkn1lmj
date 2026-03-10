<?php

namespace App\Models;

// ini tinker debug
// $year = YearCover::create([
// 'year' => 2024,
// 'cover_path' => 'cover.jpg',
// 'youtube_link' => 'testlink'
// ]);

use Illuminate\Database\Eloquent\Model;

class YearCover extends Model
{
    protected $fillable = [
        'year',
        'cover_path',
        'youtube_link',
    ];

    public function books() {
        return $this->hasMany(TableBook::class, 'year_cover_id');
    }
}
