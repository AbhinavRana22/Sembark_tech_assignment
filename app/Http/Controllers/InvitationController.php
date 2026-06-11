<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function show(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->firstOrFail();

        if (!empty($user->password)) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Invitation already accepted.'
                );
        }
        return view(
            'auth.accept-invitation',
            compact('user')
        );
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'max:255'],
            'password' => [
                'required',
                'confirmed',
            ]
        ]);

        $user = User::where('email',$request->email)->firstOrFail();

        if (!empty($user->password)) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Account already activated.'
                );
        }

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        Auth::login($user);
        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Account activated successfully.'
            );
    }
}
