<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserDashboard\UserDashboard;
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
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth'])->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/logout', [LogoutController::class, 'index'])->name('logout')->middleware('auth');
Route::post('/logout', [LogoutController::class, 'store'])->middleware('auth');

/**
 * User dashboard routes
 */
Route::get('/user-dashboard', [UserDashboard::class, 'index'])->name('user-dashboard')->middleware('auth');
Route::get('/user-dashboard/recap', [UserDashboard::class, 'index'])->name('user-dashboard.recap')->middleware('auth');
Route::get('/user-dashboard/courses', [UserDashboard::class, 'indexCourses'])->name('user-dashboard.courses')->middleware('auth');

Route::get('/user-dashboard/personal-data', function () {
	return redirect('/user-dashboard');
})->name('user-dashboard.personal-data')->middleware('auth');

// Route::get('/user-dashboard/personal-data', [UserDashboard::class, 'indexPersonalData'])->name('user-dashboard.personal-data')->middleware('auth');

Route::post('/user-dashboard/personal-data', [UserDashboard::class, 'storePersonalData'])->middleware('auth');

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
