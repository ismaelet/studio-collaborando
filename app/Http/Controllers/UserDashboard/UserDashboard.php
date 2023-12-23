<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Controller {

	/**
	 * Render the user dashboard
	 */
	public function index() {
		return view('user-dashboard.recap')
			->with('locationTag', 'user-dashboard')
			->with('title', Auth::user()->name . ' - Dashboard');
	}
}
