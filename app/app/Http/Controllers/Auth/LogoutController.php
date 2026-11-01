<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LogoutController extends Controller
{
    /**
     * Render the logout page
     */
    public function index()
    {
        return Inertia::render('Auth/Logout')
            ->with('locationTag', 'logout')
            ->with('title', 'Logout');
    }

    /**
     * Authenticate the user
     */
    public function store(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
