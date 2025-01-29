<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Admin
    public function showDashboard(){
        return view('admin.dashboard');
    }

    public function user_table(){
        return view('admin.user_table');
    }

    //Patient
    public function showPatientDashboard(){
        return view('patient.dashboard');
    }

    //Doctor
    public function showDoctorDashboard(){
        return view('doctor.dashboard');
    }

}