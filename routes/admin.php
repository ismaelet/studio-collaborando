<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Sections\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */
Route::prefix('admin')->middleware('admin')->group(function () {
	// Admin dashboard home
	Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
	Route::post('/dashboard', [HomeController::class, 'update']);

	// Users
	Route::controller(UserController::class)->group(function () {
		Route::get('/users', 'index')->name('admin.users');
		Route::get('/users/{id}', 'show')->name('admin.users.edit');
		Route::post('/users/{id}', 'update');
	});
});
