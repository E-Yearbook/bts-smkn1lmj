<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Book\BookCategoryController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\YearBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\View\ViewBookController;

Route::get('/', [YearBookController::class, 'home']);

Route::get('/book/{year}', [ViewBookController::class, 'ViewBook'])->name('book');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->name('dashboard');

    // Year Cover CRUD
    Route::get('/yearcover', [YearBookController::class, 'index'])->name('yearcover');
    Route::get('/yearcover/create',[YearBookController::class, 'create'])->name('yearcover.create');
    Route::post('/yearcover',[YearBookController    ::class, 'store'])->name('yearcover.store');
    Route::get('/yearcover/{yearcover}',[YearBookController::class, 'show'])->name('yearcover.show');
    Route::get('/yearcover/{yearcover}/edit', [YearBookController::class, 'edit'])->name('yearcover.edit');
    Route::put('/yearcover/{yearcover}',[YearBookController::class, 'update'])->name('yearcover.update');
    Route::delete('/yearcover/{yearcover}', [YearBookController::class, 'destroy'])->name('yearcover.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Books CRUD
    Route::get('/books',              [BookController::class, 'index'])->name('books.index');
    Route::get('/books/search',       [BookController::class, 'search'])->name('books.search');
    Route::get('/api/books/search',   [BookController::class, 'searchApi'])->name('books.search-api');
    Route::get('/books/create',       [BookController::class, 'create'])->name('books.create');
    Route::post('/books',             [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}',       [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit',  [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}',       [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}',    [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('/categories',            [BookCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create',     [BookCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories',           [BookCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit',  [BookCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}',       [BookCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}',    [BookCategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login-post');
