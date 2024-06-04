<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RememberMeToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Make sure this model exists

class AuthController extends Controller
{
    public function signup(){
        return view('dashboard.signup');
    }

    public function signup_attempt(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email'
        ]);
        $password = Hash::make($request->password);
        $email = $request->email;
        $username = $request->username;
        DB::table('users')->insert([
            'username'=>$username,
            'password_hash'=>$password,
            'email'=>$email
        ]);
        return response()->json(['message' => 'Sign Up successfully'], 200);
    }

    public function login(){
        return view('dashboard.login');
    }

    public function login_attempt(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember' => 'nullable|boolean'
        ]);
        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($request->remember){
                $token = bin2hex(random_bytes(32));
                $tokenHash = Hash::make($token);
                $expiry = Carbon::now()->addDays(30);
                
                DB::table('remember_me_tokens')->insert([
                    'user_id' => $user->id,
                    'token_hash' => $tokenHash,
                    'expires_at' => $expiry
                ]);
                setcookie('remember_me', $token, $expiry->timestamp, '/', '', true, true);
            }
            return response()->json(['message' => 'Logged in successfully'], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        if (isset($_COOKIE['remember_me'])) {
            setcookie('remember_me', '', time() - 3600, '/', '', true, true); // Unset the cookie
        }

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function checkRememberMeToken(Request $request)
    {
        if (isset($_COOKIE['remember_me'])) {
            $token = $_COOKIE['remember_me'];
            
            // Search for the token in the database
            $rememberMeToken = RememberMeToken::where('token_hash', $token)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if ($rememberMeToken && Hash::check($token, $rememberMeToken->token_hash)) {
                $userId = $rememberMeToken->user_id;
                Auth::loginUsingId($userId);

                return response()->json(['message' => 'Logged in successfully with remember me token'], 200);
            }
        }

        return response()->json(['message' => 'Invalid or expired remember me token'], 401);
    }
}
