<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RecoverController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Mail\Newsletter as Mailer;
use App\Models\Newsletter\Newsletter;
use App\Models\Newsletter\Subscriber;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    return Inertia::render('Home');
});

Route::get('/services', function () {
    return Inertia::render('Home');
})->name('services');

Route::get('/pet-therapy', function () {
    return Inertia::render('Home');
})->name('pet-therapy');

Route::get('/courses', function () {
    return Inertia::render('Home');
})->name('courses');

Route::get('/contacts', function () {
    return Inertia::render('Home');
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
if (file_exists(__DIR__.'/user-dashboard.php')) {
    require __DIR__.'/user-dashboard.php';
}

/**
 * Admin routes
 */
if (file_exists(__DIR__.'/admin.php')) {
    require __DIR__.'/admin.php';
}

// Misc
Route::get('/privacy', function () {
    return Inertia::render('Home');
})->name('privacy');

// Newsletter
Route::get('/sendNewsletter', function () {
    $newsletterData = Newsletter::orderByDesc('id')->first();

    if ($newsletterData) {
        $subscribers = Subscriber::where('last_sent_newsletter_id', '<', $newsletterData->id)
            ->orWhereNull('last_sent_newsletter_id')
            ->get();

        foreach ($subscribers as $subscriber) {
            $mailer = Mail::to($subscriber->email);

            try {
                $mailer->send(new Mailer($subscriber, $newsletterData->id));
                $subscriber->update(['last_sent_newsletter_id' => $newsletterData->id]);
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                echo 'There was an issue sending the email: '.$errorMessage.'<br><br>';
            }
        }
    }
});

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.subscribe');
