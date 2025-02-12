<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function register(Request $request)
    {
        // Process registration here
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the patient
        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Hashing is handled by the model
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Patient registered successfully!');


    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Ensure this matches your Blade file path
    }
}
