<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    // Method to retrieve patients with pagination
    public function show_patient_table(Request $request)
    {
        $perPage = 10;  
        $page = $request->get('page', 1); 
        $offset = ($page - 1) * $perPage;  

        $patients = DB::select('
            SELECT id, name, age, email, phone_number, address, emergency_address
            FROM patients
            LIMIT :perPage OFFSET :offset', [
            'perPage' => $perPage,
            'offset' => $offset,
        ]);

        // Get total count of patients
        $totalPatients = DB::table('patients')->count();

        $totalPages = ($totalPatients > 0) ? ceil($totalPatients / $perPage) : 1;

        return view('admin.user_table', compact('patients', 'page', 'totalPages', 'totalPatients', 'perPage'));
    }

    public function getAvailableSlots(Request $request){
        $specialty = request('speciality'); // Get selected specialty
        $doctorId = request('doctor'); // Get selected doctor
        $date = request('datepicker-actions'); // Get selected date

    $query = DB::table('time_slots')
        ->join('doctors', 'time_slots.doctor_id', '=', 'doctors.id')
        ->where('time_slots.status', 'Available') // Only available slots
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
            'doctors.department',
            'doctors.degree',
            'time_slots.date',
            'time_slots.start_time',
            'time_slots.end_time'
        )->get();

    return response()->json($availableSlots);
    }

    public function destroy($patientId)
    {
        try {
            // Raw SQL query to delete the patient record
            DB::delete('DELETE FROM patients WHERE id = :patientId', ['patientId' => $patientId]);

            return redirect()->route('admin.patient')->with('success', 'Patient removed successfully!');
        } catch (\Exception $e) {
            Log::error('Error while removing patient: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }
}
