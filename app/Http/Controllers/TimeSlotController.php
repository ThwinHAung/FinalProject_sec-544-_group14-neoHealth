<?php

namespace App\Http\Controllers;

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
        $validatedData['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
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
        $doctorId = $request->doctor;
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
    

    public function index()
    {
        $timeSlots = TimeSlot::all();
        return response()->json($timeSlots);
    }

    
}
