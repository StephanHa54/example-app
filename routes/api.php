<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/**
 * Auth routes
 */
Route::prefix('auth')->controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware(['auth:sanctum'])->group(function(){
        Route::get('logout', 'logout');
        Route::get('user', 'user'); 
    });    
});

/**
 * User profile routes
 */
Route::prefix('profile')->controller(ProfileController::class)->middleware(['auth:sanctum'])->group(function(){
    Route::put('updateUser', 'updateUser');
    Route::put('updatePassword', 'updatePassword');
    Route::post('uploadAvatar', 'uploadAvatar');
    Route::delete('removeAvatar', 'removeAvatar');
});