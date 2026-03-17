<?php

namespace App\Http\Controllers\Book;

use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookCategoryController extends Controller
{
    public function index()
    {
        $categories = BookCategory::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100|unique:book_categories,name',
        ], [
            'name.required' => 'Category name is required.',
            'name.min'      => 'Category name must be at least 2 characters.',
            'name.max'      => 'Category name must be no more than 100 characters.',
            'name.unique'   => 'Category name already exists.',
        ]);

        BookCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = BookCategory::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100|unique:book_categories,name,' . $id,
        ], [
            'name.required' => 'Category name is required.',
            'name.min'      => 'Category name must be at least 2 characters.',
            'name.max'      => 'Category name must be no more than 100 characters.',
            'name.unique'   => 'Category name already exists.',
        ]);

        $category = BookCategory::findOrFail($id);
        $category->update(['name' => $request->name]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        BookCategory::destroy($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
