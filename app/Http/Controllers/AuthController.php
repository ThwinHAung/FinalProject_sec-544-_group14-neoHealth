<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function logout(Request $request)
{
    // Clear all authentication-related session keys
    $request->session()->forget(['admin', 'patient', 'doctor']);
    
    // Optionally invalidate the entire session for extra security
    $request->session()->invalidate();
    $request->session()->regenerateToken(); // Regenerate CSRF token

    return redirect()->route('login')->with('success', 'Logged out successfully');
}
    //
    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

//Using raw SQL for login increases the risk of SQL injection, bypasses Laravel's built-in security features like password hashing and rate-limiting, and makes the code harder to maintain and less portable.
//so ajarn please
    public function login(Request $request)
    {

    $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    $admin = Admin::where('email', $validatedData['email'])->first();
    if ($admin && Hash::check($validatedData['password'], $admin->password)) {
        session(['admin' => $admin]);
        return redirect()->route('admin.dashboard')->with('success', 'Login successful');
    }

    $patient = Patient::where('email', $validatedData['email'])->first();

    if ($patient && Hash::check($validatedData['password'], $patient->password)) {
        session(['patient' => $patient]);
        return redirect()->route('patient.dashboard')->with('success', 'Login successful');
    }

    $doctor = Doctor::where('email', $validatedData['email'])->first();
    if ($doctor && Hash::check($validatedData['password'], $doctor->password)) {
        session(['doctor' => $doctor]);
        return redirect()->route('doctor.dashboard')->with('success', 'Login successful');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        //this is using laravel Eloquent for crud ( inserting )

        // $patient = Patient::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);
        // session(['patient' => $patient]);


        //this is using Raw SQL insert query to store the new patient

        $hashedPassword = Hash::make(value: $request->password);

        DB::insert('INSERT INTO patients (name, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [
            $request->name,
            $request->email,
            $hashedPassword,
            now(),   // current timestamp for created_at
            now(),   // current timestamp for updated_at
        ]);
    
        $patient = DB::select('SELECT * FROM patients WHERE email = ?', [$request->email]);
    
        session(['patient' => $patient[0]]);

        return redirect()->route('patient.dashboard')->with('success', 'Patient registered successfully!');


    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Ensure this matches your Blade file path
    }
}
