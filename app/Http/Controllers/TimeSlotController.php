<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class TimeSlotController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        
        // Convert date to Y-m-d format
        $validatedData['date'] = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');
        $formatedDate = $validatedData['date'];

        // TimeSlot::create($validatedData);
        // DB::table('time_slots')->insert([
        //     'doctor_id' => $validatedData['doctor_id'],
        //     'date' => $formatedDate,
        //     'start_time' => $validatedData['start_time'],
        //     'end_time' => $validatedData['end_time'],
        //     'created_at' => DB::raw('NOW()'),
        //     'updated_at' => DB::raw('NOW()'),
        // ]);
        DB::insert(
            'INSERT INTO time_slots (doctor_id, date, start_time, end_time, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())',
            [
                $validatedData['doctor_id'],
                $formatedDate,
                $validatedData['start_time'],
                $validatedData['end_time']
            ]
        );
        return redirect()->back()->with('success', 'Time slot added successfully!');
    }

    public function getAvailableSlots(Request $request) {
        $specialty = $request->speciality;
        ///check here if the doctor_id is passed
        $doctorId = $request->doctor_id;
        $date = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');
        // dd($date);
        $query = DB::table('time_slots')
            ->join('doctors', 'time_slots.doctor_id', '=', 'doctors.id')
            ->where('time_slots.status', 'Available')
            ->where('time_slots.date', $date);
    
        if ($specialty) {
            $query->where('doctors.specialty', $specialty);
        }
    
        if ($doctorId) {
            $query->where('doctors.id', $doctorId);
        }
        $availableSlots = $query->select(
                'time_slots.id',
                'doctors.id as doctor_id',
                'doctors.specialty',
                'time_slots.date',
                'time_slots.start_time',
                'time_slots.end_time'
            )->get();
    // dd($availableSlots);
        return response()->json($availableSlots);
    }

    public function bookAppointment(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'specialty' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time_slot_id' => 'required|exists:time_slots,id',
        ]);

        $patient_id = session('patient.id'); 

        // Create the appointment
        DB::insert(
            "INSERT INTO appointments (patient_id, doctor_id, description, time_slot_id, status, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())",
            [
                $patient_id,
                $validated['doctor_id'],
                $request->description,
                $validated['time_slot_id'],
                'Booked'
            ]
        );

        return response()->json(['success' => true, $patient_id]);
    }

    public function changeAppointment(Request $request)
    {
        $new_time_slot_id = $request->time_slot_id;
        $appointment_id = $request->appointment_id;
        $description = $request->description;
        // Validate the request data
        $validated = $request->validate([
            'appointment_id' => 'required',
            'time_slot_id' => 'required|exists:time_slots,id',
        ]);

        DB::update(
            "UPDATE appointments SET time_slot_id = ?, description = ? ,updated_at = NOW() WHERE id = ?",
            [$new_time_slot_id, $description, $appointment_id]
        );

        return response()->json(data: ['success' => true]);
    }
    

    public function index()
    {
        $timeSlots = TimeSlot::all();
        return response()->json($timeSlots);
    }

    public function cancel($id)
{
    // Update the status of the appointment to 'Cancelled'
    $updated = DB::table('appointments')
        ->where('id', $id)
        ->update(['status' => 'Cancelled']);

    if ($updated) {
        return response()->json(['message' => 'Appointment cancelled successfully']);
    } else {
        return response()->json(['message' => 'Failed to cancel appointment'], 400);
    }
}




    
}
