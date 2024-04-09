<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RecoverController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\UserDashboard\UserCoursesController;
use App\Http\Controllers\UserDashboard\UserDataController;
use App\Http\Controllers\UserDashboard\UserRecapController;
use App\Mail\Newsletter as Mailer;
use App\Models\Newsletter\Newsletter;
use App\Models\Newsletter\Subscriber;
use Illuminate\Support\Facades\Mail;
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
	return view('home');
})->name('home');

Route::get('/home', function () {
	return view('home');
});

Route::get('/services', function () {
	return view('home');
})->name('services');

Route::get('/pet-therapy', function () {
	return view('home');
})->name('pet-therapy');

Route::get('/courses', function () {
	return view('home');
})->name('courses');

Route::get('/contacts', function () {
	return view('home');
})->name('contacts');

/**
 * Auth routes
 */
Route::middleware('guest')->group(function () {
	Route::get('/login', [LoginController::class, 'index'])->name('login');
	Route::post('/login', [LoginController::class, 'auth']);

	Route::get('/register', [RegisterController::class, 'index'])->name('register');
	Route::post('/register', [RegisterController::class, 'store']);

	Route::get('/recover', [RecoverController::class, 'index'])->name('auth.recover');
	Route::post('/recover', [RecoverController::class, 'store']);
});

Route::middleware('auth')->group(function () {
	Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
	Route::post('/logout', [LogoutController::class, 'store']);
});

Route::middleware('guest')->name('auth.reset')->group(function () {
	Route::get('/reset', [ResetController::class, 'index']);
	Route::post('/reset', [ResetController::class, 'update']);
});

/**
 * User dashboard routes
 */
if (file_exists(__DIR__ . '/user-dashboard.php')) include_once __DIR__ . '/user-dashboard.php';

/**
 * Admin routes
 */
if (file_exists(__DIR__ . '/admin.php')) include_once __DIR__ . '/admin.php';

// Misc
Route::get('/privacy', function () {
	return view('home');
})->name('privacy');

// Newsletter
Route::get('/sendNewsletter', function () {
	$newsletterData = Newsletter::where('sent', 0)->first();
	$subscribers = Subscriber::all();

	if ($newsletterData->count()) {
		foreach ($subscribers as $subscriber) {
			Mail::to($subscriber->email)->send(new Mailer($subscriber, $newsletterData->id));
		}
	}

	$newsletterData->sent = 1;
	$newsletterData->save();
});
