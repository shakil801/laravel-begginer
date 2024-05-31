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
}
