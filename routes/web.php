<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontendController::class, 'index'])->name('index');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// user //
Route::get('/user/update', [UserController::class, 'user_update'])->name('user.update');
Route::post('/user.update.post', [UserController::class, 'user_update_post'])->name('user.update.post');
Route::post('/password/update',[UserController::class,'password_update'])->name('password.update');
Route::post('/photo/update',[UserController::class,'photo_update'])->name('photo.update');
