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

Route::get('/rankings', [UserController::class, 'rankings'])->name('rankings');

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


Route::get('/admin/achievements', [\App\Http\Controllers\AchievementController::class, 'index'])->name('achievements.index');
Route::get('/admin/achievements/create', [\App\Http\Controllers\AchievementController::class, 'create'])->name('achievements.create');
Route::post('/admin/achievements', [\App\Http\Controllers\AchievementController::class, 'store'])->name('achievements.store');
Route::get('/admin/achievements/{achievement}/edit', [\App\Http\Controllers\AchievementController::class, 'edit'])->name('achievements.edit');
Route::put('/admin/achievements/{achievement}', [\App\Http\Controllers\AchievementController::class, 'update'])->name('achievements.update');
Route::delete('/admin/achievements/{achievement}', [\App\Http\Controllers\AchievementController::class, 'destroy'])->name('achievements.destroy');
