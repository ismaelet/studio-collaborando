<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\GenericMail;
use App\Models\User;
use App\Models\User\UserReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RecoverController extends Controller {

	/**
	 * Render the recover page
	 */
	public function index() {

		return view('auth.recover')
			->with('locationTag', 'recover')
			->with('title', 'Recupero accesso');
	}

	/**
	 * Process the request
	 */
	public function store(Request $request) {

		// Validation
		$this->validate($request, [
			'email' => 'required|email',
		]);

		// Process the request
		$email = $_POST['email'];
		$user = User::where('email', $email)->first();

		if ($user) {
			// Generate reset security code
			$securityCode = Str::random(60);

			UserReset::updateOrCreate(
				['user_id' => $user->id],
				['security_code' => $securityCode,]
			);

			// Generare the recovery endpoint
			$resetEndpoint = env('APP_URL') . '/reset?user_id=' . $user->id . '&security_code=' . $securityCode;

			// Generate the email
			$subject = 'Recupero dati di accesso';
			$content = '
					<h2 style="text-align: center; padding-bottom: 32px; font-weight: 600;">Recupero dati</h2>
					<p>
						L\'indirizzo email associato al tuo account, necessario per accedere, è:<br>' . $email . '.<br><br>
						Per resettare la tua password puoi usare questo link:<br><a href="' . $resetEndpoint . '">' . $resetEndpoint . '</a>
					</p>';

			$mail = new GenericMail($subject, $content);

			// Send the email
			Mail::to($email)->send($mail);
		}

		return redirect()->route('auth.recover')
			->with('locationTag', 'recover')
			->with('title', 'Recupero accesso')
			->with('submitted', true)
			->with('email', $email)
			->with('not_found', !$user);
	}
}
