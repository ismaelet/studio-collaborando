<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserDataController extends Controller
{
    /**
     * Render the personal data page
     */
    public function index()
    {
        return Inertia::render('UserDashboard/PersonalData')
            ->with('locationTag', 'user-dashboard')
            ->with('title', 'Profilo - Dati personali');
    }

    /**
     * Store the user data
     */
    public function update(Request $request)
    {
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

    public function password(Request $request)
    {
        $validated = $request->validate([
            'old_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed'],
        ]);
        $request->user()->update(['password' => Hash::make($validated['password'])]);

        return back()->with('success', 'Password aggiornata correttamente.');
    }
}
