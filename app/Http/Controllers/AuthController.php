<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure this matches your Blade file path
    }

    public function login(Request $request)
    {
        // Process login here
    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Ensure this matches your Blade file path
    }
}
