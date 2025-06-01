<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EcoCycleController; // ini harus ditambahkan
use App\Http\Controllers\DiscussionController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [DiscussionController::class, 'index'])->name('forum');
    Route::post('/forum', [DiscussionController::class, 'store'])->name('forum.create');
    Route::post('/forum/{discussion}/reply', [DiscussionController::class, 'reply'])->name('forum.reply');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [DiscussionController::class, 'index'])->name('forum');
    Route::post('/forum', [DiscussionController::class, 'store'])->name('forum.create');
    Route::post('/forum/{discussion}/reply', [DiscussionController::class, 'reply'])->name('forum.reply');
    Route::post('/forum/{discussion}/like', [DiscussionController::class, 'like'])->name('forum.like');
});


Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/forum', [\App\Http\Controllers\AdminForumController::class, 'index'])->name('admin.forum.manage');
    Route::delete('/admin/forum/discussion/{discussion}', [\App\Http\Controllers\AdminForumController::class, 'deleteDiscussion'])->name('admin.forum.discussion.delete');
    Route::delete('/admin/forum/reply/{reply}', [\App\Http\Controllers\AdminForumController::class, 'deleteReply'])->name('admin.forum.reply.delete');
});

Route::middleware(['auth', 'role:Vendor'])->group(function () {
    Route::get('/vendor-dashboard', function () {
        return view('vendor-dashboard');
    });

    // Vendor self-management routes
    Route::get('/vendor/profile', [\App\Http\Controllers\VendorController::class, 'createOrEdit'])->name('vendor.profile');
    Route::post('/vendor/profile', [\App\Http\Controllers\VendorController::class, 'storeOrUpdate'])->name('vendor.profile.storeOrUpdate');
    Route::get('/vendor/requests', [\App\Http\Controllers\VendorController::class, 'viewRequests'])->name('vendor.requests');
});