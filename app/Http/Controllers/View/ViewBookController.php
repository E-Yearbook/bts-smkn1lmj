<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\YearCover;
use Illuminate\Http\Request;

class ViewBookController extends Controller
{
    public function ViewBook($year)
    {
        $yearCover = YearCover::where('year', $year)->firstOrFail();

        $categories = BookCategory::whereHas('books', function ($q) use ($yearCover) {
            $q->where('year_cover_id', $yearCover->id);
        })->get();

        $booksByCategory = Book::where('year_cover_id', $yearCover->id)
            ->with('category')
            ->get()
            ->groupBy('book_category_id');

        $colorCycle = ['indigo', 'violet', 'blue', 'emerald', 'rose'];

        $categoriesData = $categories->values()->map(function ($cat, $index) use ($booksByCategory, $colorCycle) {
            $books = $booksByCategory->get($cat->id, collect());
            return [
                'slug'  => \Illuminate\Support\Str::slug($cat->name),
                'label' => $cat->name,
                'color' => $colorCycle[$index % count($colorCycle)],
                'books' => $books->map(fn($b) => [
                    'id'        => $b->id,
                    'title'     => $b->name,
                    'publisher' => $b->publisher,
                    'cover'     => $b->book_cover ? 'storage/' . $b->book_cover : null,
                    'file'      => $b->book_path  ? asset('storage/' . $b->book_path) : null,
                ])->toArray(),
            ];
        })->toArray();

        $uncategorized = $booksByCategory->get(null, collect());
        if ($uncategorized->isNotEmpty()) {
            $categoriesData[] = [
                'slug'  => 'lainnya',
                'label' => 'Lainnya',
                'color' => 'rose',
                'books' => $uncategorized->map(fn($b) => [
                    'id'        => $b->id,
                    'title'     => $b->name,
                    'publisher' => $b->publisher,
                    'cover'     => $b->book_cover ? 'storage/' . $b->book_cover : null,
                    'file'      => $b->book_path  ? asset('storage/' . $b->book_path) : null,
                ])->toArray(),
            ];
        }

        return view('book', [
            'year'                => $year,
            'yearCover'           => $yearCover,
            'categories'          => $categoriesData,
            'youtubeLink'         => $yearCover->youtube_link_sambutan ?? null,
            'youtubeLinkAngkatan' => $yearCover->youtube_link_angkatan ?? null,
        ]);
    }
}