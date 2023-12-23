<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserDashboard\UserDashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * App routes
 */
Route::get('/', function () {
	abort(503);
})->name('home');

Route::get('/services', function () {
	abort(503);
})->name('services');

Route::get('/pet-therapy', function () {
	abort(503);
	abort(503);
})->name('pet-therapy');

Route::get('/courses', function () {
	abort(503);
})->name('courses');

Route::get('/contacts', function () {
	abort(503);
})->name('contacts');

/**
 * Auth routes
 */
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth']);

Route::get('/register', function () {
	abort(503);
})->name('register');

Route::get('/register', function () {
	abort(503);
})->name('register');

Route::get('/logout', function () {
	abort(503);
})->name('logout');

/**
 * User dashboard routes
 */
Route::get('/user-dashboard', [UserDashboard::class, 'index'])->name('user-dashboard');

Route::get('/user-dashboard/recap', function () {
	abort(503);
})->name('user-dashboard.recap');

Route::get('/user-dashboard/courses', function () {
	abort(503);
})->name('user-dashboard.courses');

Route::get('/user-dashboard/personal-data', function () {
	abort(503);
})->name('user-dashboard.personal-data');

// Misc
Route::get('/privacy', function () {
	abort(503);
})->name('privacy');
