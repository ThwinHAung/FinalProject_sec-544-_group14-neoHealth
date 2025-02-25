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
        $today = Carbon::now()->toDateString();
        $totalAppointmentsToday = DB::select("SELECT COUNT(*) as total FROM appointments WHERE DATE(created_at) = ?", [$today])[0]->total;

        return view('admin.dashboard', compact('totalDoctors', 'totalPatients', 'totalAppointmentsToday'));
    }

    public function user_table(){
        return view('admin.user_table');
    }
    public function appointment_table(){
        return view('admin.appointment_table');
    }

    //Patient
    public function showPatientDashboard(){
        if (!session()->has('patient')) {
            return redirect()->route('login'); // Redirect to register if no session
        }
        return view('patient.dashboard', ['patient' => session('patient')]);
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

    public function showAppointmentHistory(){
        return view('patient.booking_history');
    }
    public function showPrescription(){
        return view('patient.prescription');
    }

    //Doctor
    public function showDoctorDashboard(){
        if (!session()->has('doctor')) {
            return redirect()->route('login')->with('error', 'Please log in as a doctor.');
        }

        // Get the logged-in doctor ID from the session
        $doctorId = session('doctor')->id;

        // Get today's date and the first & last date of the current month
        $today = Carbon::now()->toDateString();
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

        return view('doctor.dashboard', compact('totalPatientsDaily', 'totalPatientsMonthly'));
    }

    public function showAppointmentHistoryAtDoctor(){
        return view('doctor.booking_history');
    }

    public function CreateWorkingSchedule(){
    $doctor = session('doctor');
    $doctorId = $doctor->id;
    $timeSlots = DB::select('SELECT * FROM time_slots WHERE doctor_id = ?', [$doctorId]);
    return view('doctor.time_slot', ['timeSlots' => $timeSlots]);
    }

    public function CreatePresctiption(){
        return view('doctor.medicine_prescription');
    }

}