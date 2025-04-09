<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcoNewsController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/econews', [NewsController::class, 'index'])->name('econews');
Route::get('/econews/category/{id}', [EcoNewsController::class, 'filterByCategory'])->name('econews.filter.category');
Route::get('/econews/tag/{id}', [EcoNewsController::class, 'filterByTag'])->name('econews.filter.tag');
Route::get('/econews/{id}', [App\Http\Controllers\NewsController::class, 'show'])->name('econews.detail');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/upload-picture', [UserController::class, 'uploadProfilePicture'])->name('profile.uploadPicture');
    Route::post('/profile/deactivate', [UserController::class, 'deactivateAccount'])->name('profile.deactivate');
