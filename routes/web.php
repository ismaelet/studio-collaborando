<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserDashboardController;
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

// App routes
Route::get('/', function () {
	return view('pages.home');
})->name('home');

Route::get('/home', function () {
	return view('pages.home');
})->name('home');

Route::get('/services', function () {
	abort(404);
})->name('services');

Route::get('/pet-therapy', function () {
	abort(404);
})->name('pet-therapy');

Route::get('/courses', function () {
	abort(404);
})->name('courses');

Route::get('/contacts', function () {
	abort(404);
})->name('contacts');

// Auth
Route::get('/login', function () {
	abort(404);
})->name('login');
Route::post('/login', function () {
	abort(404);
});

Route::get('/register', function () {
	abort(404);
})->name('register');
Route::post('/register', function () {
	abort(404);
});

// Profile
Route::get('/profile', function () {
	abort(404);
})->name('user-dashboard');

// Auth
// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('/login', [LoginController::class, 'auth']);

// Route::get('/register', [RegisterController::class, 'index'])->name('register');
// Route::post('/register', [RegisterController::class, 'store']);

// Profile
// Route::get('/profile', [UserDashboardController::class, 'index'])->name('user-dashboard');
