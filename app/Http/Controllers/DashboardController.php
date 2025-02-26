<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //Admin
    public function showDashboard(){
        $totalDoctors = DB::select("SELECT COUNT(*) as total FROM doctors")[0]->total;

        // Get total number of patients
        $totalPatients = DB::select("SELECT COUNT(*) as total FROM patients")[0]->total;

        // Get total appointments for today
        $today = Carbon::now('Asia/Bangkok')->toDateString();
        $totalAppointmentsToday = DB::select("SELECT COUNT(*) as total FROM appointments WHERE DATE(created_at) = ?", [$today])[0]->total;

        $appointmentsPerMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $startOfMonth = Carbon::now()->month($i)->startOfMonth()->toDateString();
            $endOfMonth = Carbon::now()->month($i)->endOfMonth()->toDateString();
    
            $appointmentsPerMonth[] = DB::select("
                SELECT COUNT(*) as total 
                FROM appointments 
                WHERE DATE(created_at) BETWEEN ? AND ?", 
                [$startOfMonth, $endOfMonth]
            )[0]->total;
        }

        return view('admin.dashboard', compact('totalDoctors', 'totalPatients', 'totalAppointmentsToday','appointmentsPerMonth'));
    }
    public function appointment_table(){

        $appointments = DB::table('appointments')
        ->join('patients', 'appointments.patient_id', '=', 'patients.id')
        ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')  
        ->join('time_slots', 'appointments.time_slot_id', '=', 'time_slots.id')  
        ->join('employees', 'doctors.employee_id', '=', 'employees.id') 
        ->select(
            'appointments.id',
            'appointments.status',
            'appointments.created_at as appointment_date',
            'appointments.time_slot_id',
            'appointments.description',
            'doctors.id as doctor_id',
            'time_slots.date as time_slot_date',
            'employees.name as doctor_name', 
            'patients.name as patient_name',
            'time_slots.start_time',
            'time_slots.end_time'
        )
        ->get();
    

        return view('admin.appointment_table',compact('appointments'));
    }

    public function updateAppointment(Request $request, $appointmentId)
{
    $validated = $request->validate([
        'time_slot_id' => 'required|exists:time_slots,id',
        'description' => 'nullable|string',
    ]);

    $appointment = DB::table('appointments')
        ->where('id', $appointmentId)
        ->update([
            'time_slot_id' => $validated['time_slot_id'],
            'description' => $validated['description'],
            'updated_at' => now(),
        ]);

    if ($appointment) {
        return response()->json(['message' => 'Appointment updated successfully'], 200);
    } else {
        return response()->json(['message' => 'Failed to update appointment'], 500);
    }
}


    //Patient
    public function showPatientDashboard(){
        if (!session()->has('patient')) {
            return redirect()->route('login'); 
        }
        $patient_id = session('patient')->id;

        $appointments = DB::table('appointments')
            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->join('employees', 'doctors.employee_id', '=', 'employees.id') 
            ->join('time_slots', 'appointments.time_slot_id', '=', 'time_slots.id')
            ->select(
                'appointments.id',
                'doctors.id as doctor_id',
                'doctors.specialty',
                'employees.name as doctor_name', 
                'appointments.created_at as appointment_date',
                'time_slots.date as time_slot_date',
                'time_slots.start_time',
                'appointments.description',
                'appointments.time_slot_id',
                'appointments.status'
            )
            ->where('appointments.patient_id', $patient_id)
            ->where('appointments.status', 'booked')
            ->get();
        return view('patient.dashboard', ['patient' => session('patient')],compact('appointments'));
    }
    public function makeAppointment(){
        $specialties = Doctor::select('specialty')->distinct()->get();
        return view('patient.booking',compact('specialties'));
    }

    public function getDoctorsBySpecialty(Request $request)
    {
        $specialty = $request->specialty;

        $doctors = Doctor::join('employees', 'doctors.employee_id', '=', 'employees.id')
            ->where('doctors.specialty', $specialty)
            ->select('doctors.id', 'employees.name')
            ->get();

        return response()->json($doctors);
    }

    public function showAppointmentHistory(Request $request)
    {
        if (!session()->has('patient')) {
            return redirect()->route('login');
        }
    
        $patient_id = session('patient')->id;
        $perPage = 10; // Number of appointments per page
        $page = $request->get('page', 1); // Current page, default to 1
        $offset = ($page - 1) * $perPage;
    
        // Base SQL query
        $sql = '
            SELECT 
                appointments.id,
                doctors.id AS doctor_id,
                doctors.specialty,
                employees.name AS doctor_name,
                appointments.created_at AS appointment_date,
                time_slots.date AS time_slot_date,
                time_slots.start_time,
                appointments.description,
                appointments.time_slot_id,
                appointments.status
            FROM appointments
            JOIN doctors ON appointments.doctor_id = doctors.id
            JOIN employees ON doctors.employee_id = employees.id
            JOIN time_slots ON appointments.time_slot_id = time_slots.id
            WHERE appointments.patient_id = :patient_id
            AND appointments.status != "booked"
        ';
    
        $bindings = [
            'patient_id' => $patient_id,
            'perPage' => $perPage,
            'offset' => $offset
        ];
    
        // Add LIMIT and OFFSET for pagination
        $sql .= ' LIMIT :perPage OFFSET :offset';
    
        // Execute the query with pagination
        $appointments = DB::select($sql, $bindings);
    
        // Get total count for pagination
        $countSql = '
            SELECT COUNT(*) as total 
            FROM appointments
            JOIN doctors ON appointments.doctor_id = doctors.id
            JOIN employees ON doctors.employee_id = employees.id
            JOIN time_slots ON appointments.time_slot_id = time_slots.id
            WHERE appointments.patient_id = :patient_id
            AND appointments.status != "booked"
        ';
        $totalAppointments = DB::selectOne($countSql, ['patient_id' => $patient_id])->total;
    
        // Calculate total pages
        $totalPages = ($totalAppointments > 0) ? ceil($totalAppointments / $perPage) : 1;
        $appointments = empty($appointments) ? [] : $appointments;
    
        return view('patient.booking_history', [
            'patient' => session('patient'),
            'appointments' => $appointments,
            'page' => $page,
            'totalPages' => $totalPages,
            'totalAppointments' => $totalAppointments,
            'perPage' => $perPage
        ]);
    }
    public function showPrescription(){

        $patient_id = session('patient')->id;
        $appointments = DB::table('appointments')
        ->join('patients', 'appointments.patient_id', '=', 'patients.id')
        ->join('time_slots', 'appointments.time_slot_id', '=', 'time_slots.id')
        ->join('medicine_prescriptions', 'medicine_prescriptions.appointment_id', '=', 'appointments.id')
        ->select(
        'appointments.id',
        'appointments.status',
        'appointments.created_at as appointment_date',
        'appointments.time_slot_id',
        'appointments.description',
        'medicine_prescriptions.medicine_name',
        'medicine_prescriptions.dosage',
        'medicine_prescriptions.description as prescriptions',
        'medicine_prescriptions.note',
        'medicine_prescriptions.start_date',
        'medicine_prescriptions.end_date',
        'time_slots.date'
    )
    ->where('appointments.patient_id', $patient_id)
    ->whereDate('time_slots.date', Carbon::today()->addDay()->toDateString())
    ->get();
        return view('patient.prescription',compact('appointments'));
    }

    public function searchAppointment(Request $request){
        $date = $request->input('date');

        $appointments = DB::table('appointments')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('time_slots', 'appointments.time_slot_id', '=', 'time_slots.id')
            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->join('employees', 'doctors.employee_id', '=', 'employees.id')
            ->select(
                'appointments.id',
                'appointments.status',
                'appointments.description',
                'patients.name as patient_name',
                'employees.name as doctor_name',
                'time_slots.date',
                'time_slots.start_time',
                'time_slots.end_time'
            )
            ->whereDate('time_slots.date', $date) 
            ->get();
    
        return response()->json($appointments);
    }



    public function prescriptionDetail($id){
        $appointment = DB::table('appointments')
    ->join('patients', 'appointments.patient_id', '=', 'patients.id')
    ->join('medicine_prescriptions', 'medicine_prescriptions.appointment_id', '=', 'appointments.id')
    ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')  // Join with doctors table
    ->join('employees', 'doctors.employee_id', '=', 'employees.id') // Join with employees table for the doctor's name
    ->select(
        'appointments.id',
        'appointments.status',
        'appointments.created_at as appointment_date',
        'appointments.time_slot_id',
        'appointments.description',
        'medicine_prescriptions.medicine_name',
        'medicine_prescriptions.dosage',
        'medicine_prescriptions.description as prescriptions',
        'medicine_prescriptions.note',
        'medicine_prescriptions.start_date',
        'medicine_prescriptions.end_date',
        'employees.name as doctor_name'  // Get doctor's name from the employees table
    )
    ->where('appointments.id', $id)
    ->first();

        return response()->json($appointment);
    }

    //Doctor
    public function showDoctorDashboard(){
        if (!session()->has('doctor')) {
            return redirect()->route('login')->with('error', 'Please log in as a doctor.');
        }

        // Get the logged-in doctor ID from the session
        $doctorId = session('doctor')->id;

        // Get today's date and the first & last date of the current month
        $today = Carbon::now('Asia/Bangkok')->toDateString();

        $firstDayOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $lastDayOfMonth = Carbon::now()->endOfMonth()->toDateString();

        // Get total unique patients for today
        $totalPatientsDaily = DB::select("
            SELECT COUNT(DISTINCT patient_id) as total 
            FROM appointments 
            WHERE doctor_id = ? AND DATE(created_at) = ?", 
            [$doctorId, $today]
        )[0]->total;

        // Get total unique patients for this month
        $totalPatientsMonthly = DB::select("
            SELECT COUNT(DISTINCT patient_id) as total 
            FROM appointments 
            WHERE doctor_id = ? AND DATE(created_at) BETWEEN ? AND ?", 
            [$doctorId, $firstDayOfMonth, $lastDayOfMonth]
        )[0]->total;

        $appointmentsPerMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $startOfMonth = Carbon::now()->month($i)->startOfMonth()->toDateString();
            $endOfMonth = Carbon::now()->month($i)->endOfMonth()->toDateString();
    
            $appointmentsPerMonth[] = DB::select("
                SELECT COUNT(*) as total 
                FROM appointments 
                WHERE doctor_id = ? AND DATE(created_at) BETWEEN ? AND ?", 
                [$doctorId, $startOfMonth, $endOfMonth]
            )[0]->total;
        }
        
        return view('doctor.dashboard', compact('totalPatientsDaily', 'totalPatientsMonthly','appointmentsPerMonth'));
    }

    public function showAppointmentHistoryAtDoctor(){

        $doctor_id = session('doctor')->id;
        $appointments = DB::table('appointments')
        ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
        ->join('patients', 'appointments.patient_id', '=', 'patients.id')
        ->join('employees', 'doctors.employee_id', '=', 'employees.id') 
        ->join('time_slots', 'appointments.time_slot_id', '=', 'time_slots.id')
        ->select(
            'appointments.id',
            'employees.name as doctor_name',
            'time_slots.date as appointment_date',
            'patients.name as patient_name',
            'time_slots.start_time',
            'appointments.description',
            'appointments.status'
        )
        ->where('doctors.id', $doctor_id)
        ->get();

    return view('doctor.booking_history', compact('appointments'));

    }

    public function CreateWorkingSchedule(){
    $doctor = session('doctor');
    $doctorId = $doctor->id;
    $timeSlots = DB::select('SELECT * FROM time_slots WHERE doctor_id = ?', [$doctorId]);
    return view('doctor.time_slot', ['timeSlots' => $timeSlots]);
    }



}