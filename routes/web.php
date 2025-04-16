<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EcoNewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DiscussionController;
use Illuminate\Http\Request;

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/upload-picture', [UserController::class, 'uploadProfilePicture'])->name('profile.uploadPicture');
    Route::post('/profile/deactivate', [UserController::class, 'deactivateAccount'])->name('profile.deactivate');

    Route::get('/store', [\App\Http\Controllers\ProductController::class, 'index'])->name('store.index'); // Render store.blade.php
    Route::post('/store/{vendorProduct}/redeem', [\App\Http\Controllers\ProductController::class, 'redeem'])->name('store.redeem'); // Update to use VendorProduct
});

Route::get('/vendor/profile', function () {
    return view('vendor-profile');
})->name('vendor.profile');
