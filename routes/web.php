<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('home');
});
Route::get('/book', [BookController::class, 'ViewBook'])->name('book');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->name('dashboard');

    // Tambahkan route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login-post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
