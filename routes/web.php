<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

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
