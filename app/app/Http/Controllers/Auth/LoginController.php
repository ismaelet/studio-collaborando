<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    /**
     * Render the login page
     */
    public function index()
    {
        return Inertia::render('Auth/Login')
            ->with('locationTag', 'login')
            ->with('title', 'Login');
    }

    /**
     * Authenticate the user
     */
    public function auth(Request $request)
    {
        // validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // sign in the user
        if (! auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Dati di accesso errati');
        }

        $request->session()->regenerate();

        // redirect
        return redirect()->route('user-dashboard');
    }
}
