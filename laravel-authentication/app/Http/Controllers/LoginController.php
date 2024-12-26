<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function post_login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
         // Attempt to authenticate the user
         $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to the intended page or default page
            return redirect()->intended('/home');
        }
        // Authentication failed, redirect back to the login form with errors
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'Incorrect password.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect to the login page or any other page you prefer
        return redirect('/login')->with('status', 'You have been logged out!');
    }
}
