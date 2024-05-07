<?php


use App\Http\Controllers\UserDashboard\UserCoursesController;
use App\Http\Controllers\UserDashboard\UserDataController;
use App\Http\Controllers\UserDashboard\UserRecapController;
use Illuminate\Support\Facades\Route;

/**
 * User dashboard routes
 */
Route::prefix('/user-dashboard')->middleware('auth')->group(function () {
	Route::get('/', [UserRecapController::class, 'index'])->name('user-dashboard');
	Route::get('/courses', [UserCoursesController::class, 'index'])->name('user-dashboard.courses');
	Route::get('/personal-data', [UserDataController::class, 'index'])->name('user-dashboard.personal-data');
	Route::post('/personal-data', [UserDataController::class, 'update']);
});
