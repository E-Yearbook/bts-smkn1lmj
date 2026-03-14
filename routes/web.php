<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

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

Route::get('/categories', [BookCategoryController::class, 'index'])->name('categories');
Route::post('categories', [BookCategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{id}', [BookCategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [BookCategoryController::class, 'destroy'])->name('categories.destroy');