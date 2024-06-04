<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Login successful']);
        }
        else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}
