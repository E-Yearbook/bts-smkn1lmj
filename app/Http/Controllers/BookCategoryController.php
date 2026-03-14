<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function index() {
        $category = BookCategory::all();
        
        return view('admin.categories.index', compact('category'));
    }
    public function store(Request $request) {
        BookCategory::create([
            'name' => $request->username
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $category = BookCategory::findOrFail($id);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('categories');
    }

    public function destroy($id) {
        BookCategory::destroy($id);
        return redirect()->back();
    }
}
