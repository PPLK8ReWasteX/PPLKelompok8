<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EcoCycleController; // ini harus ditambahkan

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ecocycle', [EcoCycleController::class, 'index'])->name('ecocycle.home');
});
