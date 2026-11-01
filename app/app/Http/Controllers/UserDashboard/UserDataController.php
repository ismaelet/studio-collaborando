<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UserDataController extends Controller {

	/**
	 * Render the personal data page
	 */
	public function index() {
		View::share('dashboardLocationTag', 'personal-data');

		return view('user-dashboard.personal-data')
			->with('locationTag', 'user-dashboard')
			->with('title', 'Profilo - Dati personali');
	}

	/**
	 * Store the user data
	 */
	public function update(Request $request) {
		$user = User::find(auth()->user()->id);

		// Validation
		$this->validate($request, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => [
				'required',
				'email',
				'max:255',
				Rule::unique('users')->ignore(auth()->user()->id),
			],
		]);

		// Store the user
		$user->update([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email,
		]);

		// Redirect
		return to_route('user-dashboard.personal-data')->with('success', 'Profilo aggiornato correttamente.');
	}
}
