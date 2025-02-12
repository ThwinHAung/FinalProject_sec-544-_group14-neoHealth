<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function showLoginForm(Request $request)
    {
        $request->session()->forget('patient');
        return view('auth.login'); // Ensure this matches your Blade file path
    }

    public function login(Request $request)
    {
        // Process login here
        // Validate input
    $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to authenticate
    $patient = Patient::where('email', $validatedData['email'])->first();

    if ($patient && Hash::check($validatedData['password'], $patient->password)) {
        // Store patient information in session
        session(['patient' => $patient]);

        // Return success response for web or API
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'patient' => $patient,
                'redirect' => route('patient.dashboard')
            ], 200);
        }

        // Redirect for web requests
        return redirect()->route('patient.dashboard')->with('success', 'Login successful');
    }

    // If authentication fails, return error
    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
    }

    return back()->withErrors(['email' => 'Invalid email or password']);
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
        session(['patient' => $patient]);

        return redirect()->route('patient.dashboard')->with('success', 'Patient registered successfully!');


    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Ensure this matches your Blade file path
    }
}
