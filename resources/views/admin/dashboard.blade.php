@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('header')
<h1>Admin Dashboard</h1>
@endsection
@section('content')

<h3 class="text-3xl font-semibold text-gray-800 dark:text-white">Hello
@if (session()->has('admin'))
    {{ session('admin')->name }}!
@else
    Admin!
@endif
    , Welcome to Your Health Dashboard!</h3>
    <p class="mt-4 text-gray-600 dark:text-gray-300">Here is a summary of your dashboard statistics.</p>

    <!-- Example Content -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<!-- Card 1: Total Doctors -->
    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Total Doctors</h4>
        <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">{{ $totalDoctors }}</p>
    </div>

    <!-- Card 2: Total Patients -->
    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Total Patients</h4>
        <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">{{ $totalPatients }}</p>
    </div>

    <!-- Card 3: Today's Appointments -->
    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Today's Appointments</h4>
        <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">{{ $totalAppointmentsToday }}</p>
    </div>

    </div>
    <div class="container mx-auto p-4">
      <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Monty Appointment Count</h2>
        <div class="h-64">
          <canvas id="appointmentChart"></canvas>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const ctx = document.getElementById('appointmentChart').getContext('2d');
      const appointmentChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 
              datasets: [{
                  label: 'Appointments',
                  data: @json($appointmentsPerMonth),  
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)', 
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              scales: {
                  y: {
                      beginAtZero: true  // Ensures the y-axis starts at zero
                  }
              }
          }
      });
  </script>
      
            
@endsection
