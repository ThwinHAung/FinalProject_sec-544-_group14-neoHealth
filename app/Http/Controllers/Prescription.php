<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Prescription extends Controller
{
    public function CreatePrescription()
    {
        $doctor = session('doctor');

        if (!$doctor) {
            return redirect()->route('login')->with('error', 'Doctor not found in session');
        }

        $doctor_id = $doctor->id;

        $appointments = DB::select('
            SELECT id AS appointment_id
            FROM appointments
            WHERE doctor_id = ?
        ', [$doctor_id]);

        // Fetch prescriptions with related appointment and patient data using raw SQL
        $prescriptions = DB::select('
        SELECT 
            mp.id,
            mp.medicine_name,
            mp.dosage,
            mp.start_date,
            mp.end_date,
            mp.note,
            mp.description,
            ts.date AS appointment_date,
            pat.name AS patient_name
        FROM medicine_prescriptions mp
        INNER JOIN appointments a ON mp.appointment_id = a.id
        INNER JOIN patients pat ON a.patient_id = pat.id
        INNER JOIN time_slots ts ON a.time_slot_id = ts.id
        WHERE a.doctor_id = ?
        ORDER BY mp.created_at DESC
    ', [$doctor_id]);

        if (empty($appointments)) {
            return view('doctor.medicine_prescription')
                ->with('error', 'No appointments found for this doctor')
                ->with('prescriptions', $prescriptions);
        }

        // Return the view with both appointments and prescriptions
        return view('doctor.medicine_prescription', [
            'appointments' => $appointments,
            'prescriptions' => $prescriptions
        ]);
    }

    public function storePrescription(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|integer|exists:appointments,id',
            'medicine_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'note' => 'nullable|string',
        ]);
    
        $appointment_id = $validated['appointment_id'];
        $medicine_name = $validated['medicine_name'];
        $description = $validated['description'];
        $dosage = $validated['dosage'];
        $start_date = $validated['start_date'];
        $end_date = $validated['end_date'];
        $note = $validated['note'];
    
        // Insert the prescription using raw SQL
        DB::statement('
            INSERT INTO medicine_prescriptions (appointment_id, medicine_name, description, dosage, start_date, end_date, note, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ', [
            $appointment_id,
            $medicine_name,
            $description,
            $dosage,
            $start_date,
            $end_date,
            $note,
        ]);
    
        return redirect()->route('doctor.prescription')->with('success', 'Prescription created successfully');
    }
    


}
