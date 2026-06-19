<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function logout()
    {
        // Logout using the web guard
        Auth::guard('web')->logout();

        // Simply clear the session
        session()->flush();

        // Redirect back to login
        return redirect()->route('login');
    }
}
