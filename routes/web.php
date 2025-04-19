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
    Route::get('/ecocycle/{id}', [\App\Http\Controllers\EcoCycleController::class, 'show'])->name('ecocycle.show');
    Route::get('/ecocycle/details/{id}', [\App\Http\Controllers\EcoCycleController::class, 'getDetails'])->name('ecocycle.details');
    Route::put('/ecocycle/update/{id}', [\App\Http\Controllers\EcoCycleController::class, 'update'])->name('ecocycle.update');
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});


