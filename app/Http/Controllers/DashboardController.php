<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //Admin
    public function showDashboard(){
        return view('admin.dashboard');
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
        return view('doctor.dashboard');
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