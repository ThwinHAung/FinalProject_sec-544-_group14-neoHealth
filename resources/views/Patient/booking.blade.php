@extends('layouts.patient')

@section('title', 'Patient Dashboard')
@section('content')


    <div class="mb-5 flex items-center justify-between space-x-4">
        <div class="bg-gray-900 text-gray-200 p-5 w-full">

            <h1 class="text-3xl font-bold mb-6 text-center">Book an Appointment</h1>

            <!-- Booking Form -->
            <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                <form class="space-y-6">
                    <!-- Speciality Dropdown -->
                    <div>
                        <label for="speciality" class="block text-sm font-medium text-gray-400 mb-2">Speciality</label>
                        <select id="speciality"
                            class="block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option disabled selected>Select a Speciality</option>
                            <option value="cardiology">Cardiology</option>
                            <option value="dermatology">Dermatology</option>
                            <option value="neurology">Neurology</option>
                            <option value="orthopedics">Orthopedics</option>
                            <option value="pediatrics">Pediatrics</option>
                        </select>
                    </div>

                    <!-- Doctor Dropdown -->
                    <div>
                        <label for="doctor" class="block text-sm font-medium text-gray-400 mb-2">Doctor</label>
                        <select id="doctor"
                            class="block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option disabled selected>Select a Doctor</option>
                            <option value="dr-smith">Dr. John Smith</option>
                            <option value="dr-johnson">Dr. Emma Johnson</option>
                            <option value="dr-scott">Dr. Michael Scott</option>
                            <option value="dr-williams">Dr. Robert Williams</option>
                        </select>
                    </div>

                    <!-- Calendar Date Picker -->

                    <div class="flex items-center gap-4">
                        <!-- Calendar Input -->
                        <div class="relative flex-grow max-w-fit">
                          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                          </div>
                          <input id="datepicker-actions" datepicker datepicker-buttons datepicker-autoselect-today
                            type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date">
                        </div>
                      
                        <!-- Submit Button -->
                        <div class="flex-shrink-0">
                          <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                            Search
                          </button>
                        </div>
                      </div>
                      
                </form>
            </div>
        </div>
    </div>







@endsection
