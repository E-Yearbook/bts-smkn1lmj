<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\User;
use App\Models\YearCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'yearCover', 'user'])->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = BookCategory::orderBy('name')->get();
        $yearCovers = YearCover::orderBy('year', 'desc')->get();
        return view('admin.books.create', compact('categories', 'yearCovers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'publisher'        => 'required|string|max:255',
            'book_category_id' => 'nullable|exists:book_categories,id',
            'year_cover_id'    => 'nullable|exists:year_covers,id',
            'user_id'          => 'nullable|exists:users,id',
            'book_cover'       => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'book_path'        => 'nullable|file|mimes:pdf|max:25600',
        ], [
            'name.required'      => 'Book name is required.',
            'publisher.required' => 'Publisher is required.',
            'book_cover.mimes'   => 'Cover must be JPG or PNG.',
            'book_cover.max'     => 'Cover must not exceed 5MB.',
            'book_path.mimes'    => 'Book file must be PDF.',
            'book_path.max'      => 'Book file must not exceed 25MB.',
        ]);

        $data = $request->only(['name', 'publisher', 'book_category_id', 'year_cover_id']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('book_cover')) {
            $file = $request->file('book_cover');
            $data['book_cover'] = $file->storeAs('bookcovers', 'cover_' . Str::random(10) . '.' . $file->getClientOriginalExtension(), 'public');
        }

        if ($request->hasFile('book_path')) {
            $file = $request->file('book_path');
            $data['book_path'] = $file->storeAs('bookfiles', 'book_' . Str::random(10) . '.pdf', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book "' . $request->name . '" added successfully!');
    }

    public function show(Book $book)
    {
        $book->load(['category', 'yearCover', 'user']);
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = BookCategory::orderBy('name')->get();
        $yearCovers = YearCover::orderBy('year', 'desc')->get();
        return view('admin.books.edit', compact('book', 'categories', 'yearCovers'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'publisher'        => 'required|string|max:255',
            'book_category_id' => 'nullable|exists:book_categories,id',
            'year_cover_id'    => 'nullable|exists:year_covers,id',
            'user_id'          => 'nullable|exists:users,id',
            'book_cover'       => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'book_path'        => 'nullable|file|mimes:pdf|max:25600',
        ]);

        $data = $request->only(['name', 'publisher', 'book_category_id', 'year_cover_id']);

        if ($request->hasFile('book_cover')) {
            if ($book->book_cover) Storage::disk('public')->delete($book->book_cover);
            $file = $request->file('book_cover');
            $data['book_cover'] = $file->storeAs('bookcovers', 'cover_' . Str::random(10) . '.' . $file->getClientOriginalExtension(), 'public');
        }

        if ($request->hasFile('book_path')) {
            if ($book->book_path) Storage::disk('public')->delete($book->book_path);
            $file = $request->file('book_path');
            $data['book_path'] = $file->storeAs('bookfiles', 'book_' . Str::random(10) . '.pdf', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book "' . $request->name . '" updated successfully!');
    }

    public function destroy(Book $book)
    {
        if ($book->book_cover) Storage::disk('public')->delete($book->book_cover);
        if ($book->book_path)  Storage::disk('public')->delete($book->book_path);

        $name = $book->name;
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book "' . $name . '" deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $books = Book::query();

        if ($query) {
            $books->where('name', 'like', '%' . $query . '%')
                  ->orWhere('publisher', 'like', '%' . $query . '%');
        }

        $books = $books->with(['category', 'yearCover', 'user'])->latest()->get();
        return view('admin.books.index', compact('books', 'query'));
    }

    public function searchApi(Request $request)
    {
        $query = $request->get('q', '');
        $limit = 6;

        if (!$query || strlen($query) < 2) {
            return response()->json(['books' => [], 'query' => $query]);
        }

        $books = Book::where('name', 'like', '%' . $query . '%')
                      ->orWhere('publisher', 'like', '%' . $query . '%')
                      ->with(['category', 'yearCover'])
                      ->latest()
                      ->limit($limit)
                      ->get()
                      ->map(function ($book) {
                          return [
                              'id' => $book->id,
                              'name' => $book->name,
                              'publisher' => $book->publisher,
                              'category' => $book->category?->name ?? 'Uncategorized',
                              'cover' => $book->book_cover ? asset('storage/' . $book->book_cover) : asset('img/no-cover.png'),
                              'url' => route('books.show', $book->id),
                          ];
                      });

        return response()->json(['books' => $books, 'query' => $query, 'total' => count($books)]);
    }
}
