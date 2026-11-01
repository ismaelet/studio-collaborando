<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\UserReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ResetController extends Controller
{
    /**
     * Render the reset page
     */
    public function index(Request $request)
    {

        $userId = $request->query('user_id');
        $securityCode = $request->query('security_code');

        if (! $userId || ! $securityCode) {
            return redirect()->route('auth.recover')->with('status', 'Errore durante il reset della password');
        }

        return Inertia::render('Auth/Reset')
            ->with('title', 'Reset accesso')
            ->with('userId', $userId)
            ->with('securityCode', $securityCode);
    }

    /**
     * Process the request
     */
    public function update(Request $request)
    {

        // Validation
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        // Process the request
        $user = User::find($request->user_id);
        $securityCode = $request->security_code;

        if ($user) {
            $userReset = UserReset::where('user_id', $user->id)->first();

            if ($userReset && Hash::check($securityCode, $userReset->security_code)) {
                $user->update([
                    'password' => Hash::make($request->input('password')),
                ]);

                $userReset->delete();

                return back()->with('submitted', true);
            }
        }

        return back()->with('status', 'Errore durante il reset della password');
    }
}
