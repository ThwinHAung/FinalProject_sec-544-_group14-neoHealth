<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

//Admin
Route::get('/admin_dashboard',[DashboardController::class,'showDashboard'])->name('admin.dashboard');

Route::get('/admin_dashboard/user_table',[DashboardController::class,'user_table'])->name('admin.user');
Route::get('/admin_dashboard/appointment_table',[DashboardController::class,'appointment_table'])->name('admin.appointment');
Route::get('/admin_dashboard/doctor_table',[DashboardController::class,'doctor_table'])->name('admin.doctor');

//Patient
Route::get('/patient_dashboard',[DashboardController::class,'showPatientDashboard'])->name('patient.dashboard');
Route::get('/patient_dashboard/booking',[DashboardController::class,'makeAppointment'])->name('patient.booking');
Route::get('/patient_dashboard/appointment_history',[DashboardController::class,'showAppointmentHistory'])->name('patient.appointment_history');

//Doctor 
Route::get('/doctor_dashboard',[DashboardController::class,'showDoctorDashboard'])->name('doctor.dashboard');
Route::get('/doctor_dashboard/appointment_history',[DashboardController::class,'showAppointmentHistoryAtDoctor'])->name('doctor.appointment_history');
Route::get('/doctor_dashboard/working_schedule',[DashboardController::class,'CreateWorkingSchedule'])->name('doctor.working_schedule');
Route::get('/doctor_dashboard/create_prescription',[DashboardController::class,'CreatePresctiption'])->name('doctor.create_prescription');