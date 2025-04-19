<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EcoNewsController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', function () {
    return view('landing'); 
})->name('home');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/ecocycle', [\App\Http\Controllers\EcoCycleController::class, 'index'])->name('ecocycle.home');
    Route::post('/ecocycle/store', [\App\Http\Controllers\EcoCycleController::class, 'store'])->name('ecocycle.store');
    
<<<<<<< HEAD
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/upload-picture', [UserController::class, 'uploadProfilePicture'])->name('profile.uploadPicture');
    Route::post('/profile/deactivate', [UserController::class, 'deactivateAccount'])->name('profile.deactivate');
=======






Route::middleware(['auth'])->group(function () {

    Route::post('/ecocycle/store', [\App\Http\Controllers\EcoCycleController::class, 'store'])->name('ecocycle.store');
}
>>>>>>> e095ba1 (: PPL8-17-PBI-004A-Penjadwalan-Pengambilan-Sampah)
