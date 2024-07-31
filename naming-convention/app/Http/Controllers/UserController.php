<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserAccount(){
        // declare variable
        $user = 'shakil';
        $email = 'shakkweb@gmail.com';
        $educationInfo = 'MEngg';
        
        return view('user.profile');
    }
}
