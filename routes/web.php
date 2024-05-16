<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * Web Routes
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * App Routes
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});
/**
 * File Routes
 */
Route::get('files/avatars/{var1}/{var2}', FilesController::class)->middleware(['auth:sanctum']);
/**
 * Auth Routes
 */
require __DIR__.'/auth.php';

