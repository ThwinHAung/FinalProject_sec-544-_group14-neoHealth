<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function profile(){
        $admin = session('admin');

        if (!$admin) {
            return response()->json(['error' => 'Admin not authenticated'], 401);
        }
    
        // Fetch admin details from database
        $adminData = DB::select("
            SELECT a.id, e.name, a.email, a.phone_number, e.start_date 
            FROM admins a
            JOIN employees e ON a.employee_id = e.id
            WHERE a.id = ?", [$admin['id']]);
    
        if (empty($adminData)) {
            return response()->json(['error' => 'Admin not found'], 404);
        }
    
        $admin = $adminData[0];
    
        return response()->json([
            'id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'phone_number' => $admin->phone_number,
            'start_date' => $admin->start_date,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $admin = session('admin');

        if (!$admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin not authenticated');
        }

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        // Update admin details using raw SQL
        DB::update("
            UPDATE admins 
            SET email = ?, phone_number = ? 
            WHERE id = ?", 
            [$validatedData['email'], $validatedData['phone_number'], $admin['id']]
        );

        DB::update("
            UPDATE employees 
            SET name = ? 
            WHERE id = ?", 
            [$validatedData['name'], $admin['employee_id']]
        );

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully');
    }
}

    

