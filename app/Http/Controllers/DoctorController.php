<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the doctor data
        $validated = $request->validate([
            'full-name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|confirmed|min:6',
            'department' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
        ]);

        // using laravel default creating function

        // $employee = Employee::create([
        //     'name' => $validated['full-name'],
        //     'role' => 'Doctor',
        //     'start_date'=> Carbon::now()
        // ]);
        // $doctor = Doctor::create([
        //     'employee_id'=>$employee->id,
        //     'email' => $validated['email'],
        //     'phone' => $validated['phone'],
        //     'password' => Hash::make($validated['password']),
        //     'department' => $validated['department'],
        //     'speciality' => $validated['speciality'],
        //     'degree' => $validated['degree'],
        // ]);

        //using raw sql
        try {
            // Insert into the employees table
            DB::insert('INSERT INTO employees (name, role, start_date) VALUES (?, ?, ?)', [
                $validated['full-name'],
                'Doctor',
                Carbon::now(),
            ]);
    
            // Retrieve the employee ID
            $employeeId = DB::getPdo()->lastInsertId();
    
            // Insert into the doctors table
            DB::insert('INSERT INTO doctors (employee_id, degree, department, specialty, email, password, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)', [
                $employeeId,
                $validated['degree'],
                $validated['department'],
                $validated['speciality'],
                $validated['email'],
                Hash::make($validated['password']),
                $validated['phone'],
    
            ]);
    
            DB::commit(); // Commit transaction if everything is successful
    
            return redirect()->route('admin.doctor')->with('success', 'Doctor created successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if something goes wrong
            Log::error('Error while creating doctor: ' . $e->getMessage());
        
        // You can also log the entire exception
            Log::error($e);
            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }

        // return redirect()->route('admin.doctor')->with('success', 'Doctor created successfully!');
    }

    public function show_doctor_table(Request $request)
    {
        $perPage = 10;
    
        $page = $request->get('page', 1);
    
        $offset = ($page - 1) * $perPage;
    
        // Raw SQL to retrieve doctors data with pagination
        $doctors = DB::select('
            SELECT d.id, e.name AS doctor_name, d.degree, d.department, d.specialty, d.email, d.phone_number
            FROM doctors d
            JOIN employees e ON e.id = d.employee_id
            LIMIT :perPage OFFSET :offset', [
            'perPage' => $perPage,
            'offset' => $offset,
        ]);
    
        // Get total count of doctors
        $totalDoctors = DB::table('doctors')->count();
    
        $totalPages = ($totalDoctors > 0) ? ceil($totalDoctors / $perPage) : 1;

        $doctors = empty($doctors) ? [] : $doctors;

        return view('admin.doctor_table', compact('doctors', 'page', 'totalPages', 'totalDoctors', 'perPage'));

    }

    public function edit($doctorId){

        $doctor = DB::select('
        SELECT d.id, e.name AS doctor_name, d.degree, d.department, d.specialty, d.phone_number
        FROM doctors d
        JOIN employees e ON e.id = d.employee_id
        WHERE d.id = :doctorId', ['doctorId' => $doctorId]);

        if (empty($doctor)) {
            return redirect()->route('admin.doctor')->with('error', 'Doctor not found');
        }

        return view('admin.doctor_table', ['doctor' => $doctor[0]]);
    }

    public function updateDoctor(Request $request, $doctorId)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'full-name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
        ]);
        try {
        
            // Update doctor record using raw SQL
            DB::update('
                UPDATE employees e
                JOIN doctors d ON e.id = d.employee_id
                SET e.name = :name,
                    d.degree = :degree,
                    d.department = :department,
                    d.specialty = :specialty,
                    d.phone_number = :phone
                WHERE d.id = :doctorId', [
                    'name' => $validated['full-name'],
                    'degree' => $validated['degree'],
                    'department' => $validated['department'],  
                    'specialty' => $validated['speciality'],
                    'phone' => $validated['phone'],
                    'doctorId' => $doctorId
                ]);
            return redirect()->route('admin.doctor')->with('success', 'Doctor updated successfully!');
        } catch (\Exception $e) {
            dd('error');
            Log::error('Error while updating doctor: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function destroy($doctorId)
    {
        // Raw SQL query to delete the doctor record
        DB::delete('DELETE FROM doctors WHERE id = :doctorId', ['doctorId' => $doctorId]);
    
        return redirect()->route('admin.doctor')->with('success', 'Doctor removed successfully!');
    }
}
