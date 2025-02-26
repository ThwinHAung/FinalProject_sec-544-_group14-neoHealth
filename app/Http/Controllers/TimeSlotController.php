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

    public function getDoctorAvailableSlots(Request $request) {
        $doctorId = $request->input('doctor_id');
    
        $timeSlots = DB::table('time_slots')
            ->where('doctor_id', $doctorId)
            ->where('status', 'available') 
            ->orderBy('start_time')
            ->get();
    
        return response()->json($timeSlots);
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

        DB::update(
            "UPDATE time_slots SET status = ? WHERE id = ?",
            ['Booked', $validated['time_slot_id']]
        );

        return response()->json(['success' => true, $patient_id]);
    }

    public function changeAppointment(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'time_slot_id' => 'required|exists:time_slots,id',
        ]);
    
        $new_time_slot_id = $request->time_slot_id;
        $appointment_id = $request->appointment_id;
        $description = $request->description;
    
        DB::beginTransaction();
        
        try {
            // Get the current time slot ID from the appointment
            $current_appointment = DB::selectOne(
                "SELECT time_slot_id FROM appointments WHERE id = ?",
                [$appointment_id]
            );
            
            if (!$current_appointment) {
                throw new \Exception('Appointment not found');
            }
            
            $old_time_slot_id = $current_appointment->time_slot_id;
    
            // Update the appointment with new time slot and description
            DB::update(
                "UPDATE appointments SET time_slot_id = ?, description = ?, updated_at = NOW() WHERE id = ?",
                [$new_time_slot_id, $description, $appointment_id]
            );
    
            // Update the new time slot to Booked
            DB::update(
                "UPDATE time_slots SET status = ? WHERE id = ?",
                ['Booked', $new_time_slot_id]
            );
    
            // Update the old time slot to Available (if it's different from the new one)
            if ($old_time_slot_id != $new_time_slot_id) {
                DB::update(
                    "UPDATE time_slots SET status = ? WHERE id = ?",
                    ['Available', $old_time_slot_id]
                );
            }
    
            DB::commit();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to change appointment: ' . $e->getMessage()
            ], 500);
        }
    }
    

    public function index()
    {
        $timeSlots = TimeSlot::all();
        return response()->json($timeSlots);
    }

    public function cancel($id)
    {
        DB::beginTransaction();
        
        try {
            // Get the appointment with its time slot ID
            $appointment = DB::table('appointments')
                ->where('id', $id)
                ->first();
                
            if (!$appointment) {
                throw new \Exception('Appointment not found');
            }
    
            // Update the appointment status to Cancelled
            $updated = DB::table('appointments')
                ->where('id', $id)
                ->update([
                    'status' => 'Cancelled',
                    'updated_at' => now()
                ]);
    
            if ($updated) {
                // Update the time slot status to Available
                DB::table('time_slots')
                    ->where('id', $appointment->time_slot_id)
                    ->update([
                        'status' => 'Available',
                        'updated_at' => now()
                    ]);
    
                DB::commit();
                
                return response()->json(['message' => 'Appointment cancelled successfully']);
            } else {
                throw new \Exception('Failed to update appointment status');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'message' => 'Failed to cancel appointment: ' . $e->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
{
    // Find the time slot by ID
    $timeSlot = TimeSlot::findOrFail($id);

    // Check if the time slot's status is "Booked"
    if ($timeSlot->status == 'Booked') {
        // If it's booked, redirect back with an error message
        return redirect()->back()->with('error', 'This time slot is already booked and cannot be deleted.');
    }

    // Delete the time slot
    $timeSlot->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Time slot deleted successfully.');
}



    
}
