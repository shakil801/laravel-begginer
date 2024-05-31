<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function save(Request $request){
        // dd('sdjasdsa');
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:4',
    ]);
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);
    return redirect()->route('/')->with(['message' => 'User created successfully', 'user' => $user], 201);
    }
}
