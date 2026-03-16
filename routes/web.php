<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\Book\YearBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [YearBookController::class, 'home']);

Route::get('/book', [BookController::class, 'ViewBook'])->name('book');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->name('dashboard');

    // Year Cover CRUD
    Route::get('/yearcover',                [YearBookController::class, 'index'])->name('yearcover');
    Route::get('/yearcover/create',         [YearBookController::class, 'create'])->name('yearcover.create');
    Route::post('/yearcover',               [YearBookController::class, 'store'])->name('yearcover.store');
    Route::get('/yearcover/{yearcover}',    [YearBookController::class, 'show'])->name('yearcover.show');
    Route::get('/yearcover/{yearcover}/edit', [YearBookController::class, 'edit'])->name('yearcover.edit');
    Route::put('/yearcover/{yearcover}',    [YearBookController::class, 'update'])->name('yearcover.update');
    Route::delete('/yearcover/{yearcover}', [YearBookController::class, 'destroy'])->name('yearcover.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/categories', [BookCategoryController::class, 'index'])->name('categories');
    Route::post('categories', [BookCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [BookCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [BookCategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login-post');
