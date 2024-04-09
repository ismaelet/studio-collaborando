<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class UserCoursesController extends Controller {

	/**
	 * Render the courses page
	 */
	public function index() {
		View::share('dashboardLocationTag', 'courses');

		return view('user-dashboard.courses')
			->with('locationTag', 'user-dashboard')
			->with('title', 'Profilo - Videocorsi');
	}
}
