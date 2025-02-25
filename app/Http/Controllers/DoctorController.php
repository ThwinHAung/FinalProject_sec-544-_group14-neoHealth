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
        $search = $request->input('search', ''); // Get search term from request
        
        $offset = ($page - 1) * $perPage;
    
        // Base SQL query with search capability
        $sql = '
            SELECT d.id, e.name AS doctor_name, d.degree, d.department, d.specialty, d.email, d.phone_number
            FROM doctors d
            JOIN employees e ON e.id = d.employee_id
        ';
    
        // Add WHERE clause if there's a search term
        $bindings = [
            'perPage' => $perPage,
            'offset' => $offset
        ];
    
        if (!empty($search)) {
            $sql .= ' WHERE d.id LIKE :search OR e.name LIKE :searchName';
            $bindings['search'] = "%{$search}%";
            $bindings['searchName'] = "%{$search}%";
        }
    
        $sql .= ' LIMIT :perPage OFFSET :offset';
    
        // Execute the query with search parameters
        $doctors = DB::select($sql, $bindings);
    
        // Get total count with search filter
        $countSql = 'SELECT COUNT(*) as total FROM doctors d JOIN employees e ON e.id = d.employee_id';
        if (!empty($search)) {
            $countSql .= ' WHERE d.id LIKE :search OR e.name LIKE :searchName';
            $totalDoctors = DB::selectOne($countSql, [
                'search' => "%{$search}%",
                'searchName' => "%{$search}%"
            ])->total;
        } else {
            $totalDoctors = DB::table('doctors')->count();
        }
    
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
            'specialty' => 'required|string|max:255',
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
                    'specialty' => $validated['specialty'],
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
        $employeeId = DB::table('doctors')->where('id', $doctorId)->value('employee_id');
    
        // Delete the doctor record first
        DB::delete('DELETE FROM doctors WHERE id = :doctorId', ['doctorId' => $doctorId]);
    
        // Delete the associated employee record
        if ($employeeId) {
            DB::delete('DELETE FROM employees WHERE id = :employeeId', ['employeeId' => $employeeId]);
        }
    
        return redirect()->route('admin.doctor')->with('success', 'Doctor and associated employee removed successfully!');
    }

    public function profile(){
        $doctor = session('doctor');

        if (!$doctor) {
            return response()->json(['error' => 'Doctor not authenticated'], 401);
        }
    
        // Fetch admin details from database
        $doctorData = DB::select("
            SELECT d.id, e.name, d.degree, d.department, d.specialty, d.email, d.phone_number, e.start_date 
            FROM doctors d
            JOIN employees e ON d.employee_id = e.id
            WHERE d.id = ?", [$doctor['id']]);
    
        if (empty($doctorData)) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }
    
        $doctor = $doctorData[0];
    
        return response()->json([
            'id' => $doctor->id,
            'name' => $doctor->name,
            'degree'=> $doctor->degree,
            'department'=> $doctor->department,
            'specialty'=> $doctor->specialty,
            'email' => $doctor->email,
            'phone_number' => $doctor->phone_number,
            'start_date' => $doctor->start_date,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $doctor = session('doctor');

        if (!$doctor) {
            return redirect()->route('doctor.dashboard')->with('error', 'Doctor not authenticated');
        }

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        // Update admin details using raw SQL
        DB::update("
            UPDATE doctors 
            SET email = ?, phone_number = ? 
            WHERE id = ?", 
            [$validatedData['email'], $validatedData['phone_number'], $doctor['id']]
        );

        DB::update("
            UPDATE employees 
            SET name = ? 
            WHERE id = ?", 
            [$validatedData['name'], $doctor['employee_id']]
        );

        return redirect()->route('doctor.dashboard')->with('success', 'Profile updated successfully');
    }
    
}
