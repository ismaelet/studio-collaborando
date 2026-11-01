<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserRecapController extends Controller {

	/**
	 * Render the user dashboard
	 */
	public function index() {
		View::share('dashboardLocationTag', 'recap');

		return view('user-dashboard.recap')
			->with('locationTag', 'user-dashboard')

			->with('title', Auth::user()->name . ' - Profilo');
	}
}
