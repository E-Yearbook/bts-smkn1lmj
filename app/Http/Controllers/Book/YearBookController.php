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
        $covers = YearCover::orderBy('year', 'desc')->get();
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
            'youtube_link' => 'required|url',
        ], [
            'year.required'         => 'Tahun wajib diisi.',
            'year.integer'          => 'Tahun harus berupa angka.',
            'year.min'              => 'Tahun minimal 2000.',
            'year.max'              => 'Tahun maksimal 2100.',
            'year.unique'           => 'Cover untuk tahun ini sudah ada.',
            'cover.required'        => 'Cover wajib diunggah.',
            'cover.mimes'           => 'Cover harus berformat JPG atau PNG.',
            'cover.max'             => 'Ukuran cover maksimal 5MB.',
            'youtube_link.required' => 'Link YouTube wajib diisi.',
            'youtube_link.url'      => 'Link YouTube tidak valid.',
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

        return response()->json([
            'success' => true,
            'message' => 'Cover tahun ' . $request->year . ' berhasil ditambahkan!',
            'redirect' => route('yearcover'),
        ]);
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
            'youtube_link' => 'required|url',
        ], [
            'year.required'         => 'Tahun wajib diisi.',
            'year.integer'          => 'Tahun harus berupa angka.',
            'year.unique'           => 'Cover untuk tahun ini sudah ada.',
            'cover.mimes'           => 'Cover harus berformat JPG atau PNG.',
            'cover.max'             => 'Ukuran cover maksimal 5MB.',
            'youtube_link.required' => 'Link YouTube wajib diisi.',
            'youtube_link.url'      => 'Link YouTube tidak valid.',
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

        return response()->json([
            'success' => true,
            'message' => 'Cover tahun ' . $request->year . ' berhasil diperbarui!',
            'redirect' => route('yearcover'),
        ]);
    }

    public function destroy(YearCover $yearcover)
    {
        if ($yearcover->cover_path && Storage::disk('public')->exists($yearcover->cover_path)) {
            Storage::disk('public')->delete($yearcover->cover_path);
        }

        $year = $yearcover->year;
        $yearcover->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cover tahun ' . $year . ' berhasil dihapus!',
        ]);
    }
}