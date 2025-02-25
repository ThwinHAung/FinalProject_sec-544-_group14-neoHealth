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