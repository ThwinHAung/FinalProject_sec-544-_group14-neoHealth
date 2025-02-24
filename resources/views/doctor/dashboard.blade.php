@extends('layouts.doctor')

@section('title', 'Doctor Dashboard')

@section('content')
<h3 class="text-3xl font-semibold text-gray-800 dark:text-white">Hello 
    @if (session()->has('doctor'))
    {{ session('doctor')->name }}!
@else
    Doctor!
@endif
<p class="mt-4 text-gray-600 dark:text-gray-300">We’re here to support you in delivering excellent care. Here’s a quick overview of your upcoming appointments, patient details, and medical activities.</p>

    <!-- Example Content -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Total Patient Daily</h4>
            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">15</p>
        </div>
        <!-- Card 2 -->
        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Total Patient Montly</h4>
            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">120</p>
        </div>
        <!-- Card 3 -->
        {{-- <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Revenue</h4>
            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">$12,628</p>
        </div> --}}
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
          type: 'bar',  // Bar chart; change to 'line' if you prefer a line chart
          data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],  // 12 months of the year
            datasets: [{
              label: 'Appointments',
              data: [14, 20, 18, 18, 20, 15, 10, 25, 22, 30, 28, 32],  // Sample data for each month
              backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Light green color
              borderColor: 'rgba(75, 192, 192, 1)',  // Darker green for the border
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

    {{-- <div id="date-range-picker" class="flex items-center space-x-4 mt-7">
        <div class="relative">
            <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ps-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select start date">
        </div>
        <span class="text-gray-500">to</span>
        <div class="relative">
            <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ps-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select end date">
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Patient Name</th>
                    <th scope="col" class="px-6 py-3">Appointment Date</th>
                    <th scope="col" class="px-6 py-3">Appointment Time</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Appointment Data -->
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4">1</td>
                    <td class="px-6 py-4">Alice Johnson</td>
                    <td class="px-6 py-4">2025-02-05</td>
                    <td class="px-6 py-4">10:00 AM</td>
                    <td class="px-6 py-4">Scheduled</td>
                    <td class="px-6 py-4">Regular check-up</td>
                    <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Reschedule</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Cancel</a>
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-2" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-2" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4">2</td>
                    <td class="px-6 py-4">Bob Martin</td>
                    <td class="px-6 py-4">2025-02-06</td>
                    <td class="px-6 py-4">02:00 PM</td>
                    <td class="px-6 py-4">Completed</td>
                    <td class="px-6 py-4">Skin examination</td>
                    <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Reschedule</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Cancel</a>
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-3" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-3" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4">3</td>
                    <td class="px-6 py-4">Charlie Williams</td>
                    <td class="px-6 py-4">2025-02-07</td>
                    <td class="px-6 py-4">09:30 AM</td>
                    <td class="px-6 py-4">Scheduled</td>
                    <td class="px-6 py-4">Back pain treatment</td>
                    <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Reschedule</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Cancel</a>
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-4" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-4" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4">4</td>
                    <td class="px-6 py-4">Diana Green</td>
                    <td class="px-6 py-4">2025-02-08</td>
                    <td class="px-6 py-4">11:00 AM</td>
                    <td class="px-6 py-4">Scheduled</td>
                    <td class="px-6 py-4">Routine check-up</td>
                    <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Reschedule</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Cancel</a>
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-5" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-5" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4">5</td>
                    <td class="px-6 py-4">Edward Black</td>
                    <td class="px-6 py-4">2025-02-09</td>
                    <td class="px-6 py-4">12:30 PM</td>
                    <td class="px-6 py-4">Completed</td>
                    <td class="px-6 py-4">Heart check-up</td>
                    <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Reschedule</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Cancel</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> --}}
    
    
@endsection
