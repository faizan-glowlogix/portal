<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

// use Session;

class AuthController extends Controller
{
    public function validateUser(Request $request)
    {
        session(['token' => Crypt::encryptString($request->token)]);
        session(['user' => json_decode($request->user, true)]);
        session(['authenticated' => time()]);


        return redirect('/users');
    }

    public function logout(Request $request)
    {
        session()->flush();

        return redirect('/login');
    }
}
