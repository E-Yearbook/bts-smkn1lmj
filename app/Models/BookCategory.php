<?php

namespace App\Models;

// ini tinker debug
// $category = BookCategory::create([
// 'name' => 'Otak senku 001'
// ]);

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function books() {
        return $this->hasMany(TableBook::class, 'book_category_id');
    }
    
}
