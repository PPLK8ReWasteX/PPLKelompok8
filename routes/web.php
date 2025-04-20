<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EcoCycleController; // ini harus ditambahkan

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ecocycle', [EcoCycleController::class, 'index'])->name('ecocycle.home');
    Route::post('/ecocycle/store', [\App\Http\Controllers\EcoCycleController::class, 'store'])->name('ecocycle.store');
    Route::get('/ecocycle/{id}', [\App\Http\Controllers\EcoCycleController::class, 'show'])->name('ecocycle.show');
    Route::get('/ecocycle/details/{id}', [\App\Http\Controllers\EcoCycleController::class, 'getDetails'])->name('ecocycle.details');
    Route::put('/ecocycle/update/{id}', [\App\Http\Controllers\EcoCycleController::class, 'update'])->name('ecocycle.update');
});
