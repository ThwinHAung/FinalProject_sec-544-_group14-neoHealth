<?php

namespace App\Http\Controllers;

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
