<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class UserAuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $registerUserData = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8'
        ]);

        try {

            $user = User::create([
                'name' => $registerUserData['name'],
                'email' => $registerUserData['email'],
                'password' => Hash::make($registerUserData['password']),
            ]);

            $tokenName = 'fundaToken'.rand(111,999);
            $token = $user->createToken($tokenName)->plainTextToken;

            return response()->json([
                'status' => 201,
                'message' => 'User Created Successfully',
                'data' => [
                    'user' => $user,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 201);

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Something went wrong'.$th->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required','min:8'],
        ]);

        try {

            $user = User::where('email',$credentials['email'])->first();

            if(!$user || !Hash::check($credentials['password'],$user->password)){

                return response()->json(['message' => 'Invalid Credentials'], 401);
            }

            if (Auth::attempt($credentials)) {

                $tokenName = 'fundaToken'.rand(111,999);
                $token = $user->createToken($tokenName)->plainTextToken;

                return response()->json([
                        'status' => 200,
                        'message' => 'Login Successful',
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                    ], 200);
            }else{

                return response()->json(['message' => 'Invalid credentials'], 401);
            }

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Something went wrong'.$th->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    public function logout(){
        $user = User::findOrFail(Auth::id());
        $user->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logged out successfully'
        ], 200);
    }

    public function user()
    {
        if(Auth::check()){

            $user = Auth::user();

            return response()->json([
                'message' => 'User Detail',
                'data' => $user,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Login to continue'
            ], 200);
        }
    }
}
