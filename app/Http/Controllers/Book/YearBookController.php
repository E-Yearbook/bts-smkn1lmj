<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\YearCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class YearBookController extends Controller
{
    public function index()
    {
        $covers = YearCover::orderBy('year', 'desc')->paginate(10);
        return view('admin.yearcover.index', compact('covers'));
    }

    public function create()
    {
        return view('admin.yearcover.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year'         => 'required|integer|min:2000|max:2100|unique:year_covers,year',
            'cover'        => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'youtube_link' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    preg_match_all('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $value, $matches);
                    $uniqueIds = array_unique($matches[1]);
                    if (count($uniqueIds) > 2) {
                        $fail('You cannot submit more than 2 YouTube links.');
                    }
                },
            ],
        ], [
            'year.required'         => 'Year is required.',
            'year.integer'          => 'Year must be a number.',
            'year.min'              => 'Year must be at least 2000.',
            'year.max'              => 'Year must be at most 2100.',
            'year.unique'           => 'A cover for this year already exists.',
            'cover.required'        => 'Cover is required.',
            'cover.mimes'           => 'Cover must be in JPG or PNG format.',
            'cover.max'             => 'Cover size must not exceed 5MB.',
            'youtube_link.required' => 'YouTube link is required.',
        ]);

        // Secure file upload
        $file      = $request->file('cover');
        $extension = $file->getClientOriginalExtension();
        $filename  = 'cover_' . $request->year . '_' . Str::random(8) . '.' . $extension;
        $path      = $file->storeAs('yearcovers', $filename, 'public');

        YearCover::create([
            'year'         => $request->year,
            'cover_path'   => $path,
            'youtube_link' => $request->youtube_link,
        ]);

        return redirect()->route('yearcover')->with('success', 'Cover for year ' . $request->year . ' added successfully!');
    }

    public function show(YearCover $yearcover)
    {
        return view('admin.yearcover.show', compact('yearcover'));
    }

    public function edit(YearCover $yearcover)
    {
        return view('admin.yearcover.edit', compact('yearcover'));
    }

    public function update(Request $request, YearCover $yearcover)
    {
        $request->validate([
            'year'         => 'required|integer|min:2000|max:2100|unique:year_covers,year,' . $yearcover->id,
            'cover'        => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'youtube_link' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    preg_match_all('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $value, $matches);
                    $uniqueIds = array_unique($matches[1]);
                    if (count($uniqueIds) > 2) {
                        $fail('You cannot submit more than 2 YouTube links.');
                    }
                },
            ],
        ], [
            'year.required'         => 'Year is required.',
            'year.integer'          => 'Year must be a number.',
            'year.unique'           => 'A cover for this year already exists.',
            'cover.mimes'           => 'Cover must be in JPG or PNG format.',
            'cover.max'             => 'Cover size must not exceed 5MB.',
            'youtube_link.required' => 'YouTube link is required.',
        ]);

        $data = [
            'year'         => $request->year,
            'youtube_link' => $request->youtube_link,
        ];

        if ($request->hasFile('cover')) {
            // Delete old file
            if ($yearcover->cover_path && Storage::disk('public')->exists($yearcover->cover_path)) {
                Storage::disk('public')->delete($yearcover->cover_path);
            }

            $file      = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            $filename  = 'cover_' . $request->year . '_' . Str::random(8) . '.' . $extension;
            $data['cover_path'] = $file->storeAs('yearcovers', $filename, 'public');
        }

        $yearcover->update($data);

        return redirect()->route('yearcover')->with('success', 'Cover for year ' . $request->year . ' updated successfully!');
    }

    public function destroy(YearCover $yearcover)
    {
        if ($yearcover->cover_path && Storage::disk('public')->exists($yearcover->cover_path)) {
            Storage::disk('public')->delete($yearcover->cover_path);
        }

        $year = $yearcover->year;
        $yearcover->delete();

        return redirect()->route('yearcover')->with('success', 'Cover for year ' . $year . ' deleted successfully!');
    }

    public function home()
    {
        $covers = YearCover::orderBy('year', 'desc')->get();

        $currentYear = now()->year;

        // Cari tahun sekarang, jika tidak ada ambil yang terbaru
        $activeYear = $covers->firstWhere('year', $currentYear)
                        ? $currentYear
                        : ($covers->first()->year ?? $currentYear);

        return view('home', compact('covers', 'activeYear'));
    }
}