@extends('layouts.doctor')

@section('title', 'Work Schedule')

@section('content')

        <!-- Section Heading: Work Schedule Form -->
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Enter Your Work Schedule</h2>

        <!-- Time Slot Form Section -->
        <div class="grid grid-cols-12 gap-6">
            <!-- First Column: Day Selector -->
            <div class="col-span-3">
                <label for="day" class="block text-lg text-gray-700 dark:text-gray-300">Choose Day</label>
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
            </div>

            <!-- Second Column: Start Time Dropdown (24-Hour Format) -->
            <div class="col-span-3">
                <label for="start-time" class="block text-lg text-gray-700 dark:text-gray-300">Start Time</label>
                <button id="dropdownDefaultButton1" data-dropdown-toggle="dropdown1" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Select Start Time 
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                  </button>
                  
                  <!-- Dropdown menu -->
                  <div id="dropdown1" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 max-h-48 overflow-y-auto" aria-labelledby="dropdownDefaultButton">
                      @for ($i = 0; $i < 24; $i++)
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</a>
                        </li>
                      @endfor
                    </ul>
                  </div>
            </div>

            <!-- Third Column: End Time Dropdown (24-Hour Format) -->
            <div class="col-span-3">
                <label for="end-time" class="block text-lg text-gray-700 dark:text-gray-300">End Time</label>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Select Start Time 
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                  </button>
                  
                  <!-- Dropdown menu -->
                  <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 max-h-48 overflow-y-auto" aria-labelledby="dropdownDefaultButton">
                      @for ($i = 0; $i < 24; $i++)
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</a>
                        </li>
                      @endfor
                    </ul>
                  </div>
            </div>

            <!-- Button Column: Add Time Slot -->
            <div class="col-span-3 flex items-center justify-center mt-6">
                <button type="button" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 w-full">
                    Add Time Slot
                </button>
            </div>
        </div>

        <!-- Existing Time Slots Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Day</th>
                        <th scope="col" class="px-6 py-3">Date</th> <!-- New Date Column -->
                        <th scope="col" class="px-6 py-3">Duty Time From</th>
                        <th scope="col" class="px-6 py-3">Duty Time To</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data Rows -->
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-6 py-4">1</td>
                        <td class="px-6 py-4">Monday</td>
                        <td class="px-6 py-4">2025-02-05</td> <!-- Sample Date -->
                        <td class="px-6 py-4">09:00 AM</td>
                        <td class="px-6 py-4">12:00 PM</td>
                        <td class="flex items-center px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="#" class="font-medium text-red-600 hover:underline ms-3">Delete</a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-2" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                                <label for="checkbox-table-search-2" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-6 py-4">2</td>
                        <td class="px-6 py-4">Tuesday</td>
                        <td class="px-6 py-4">2025-02-06</td> <!-- Sample Date -->
                        <td class="px-6 py-4">10:00 AM</td>
                        <td class="px-6 py-4">01:00 PM</td>
                        <td class="flex items-center px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="#" class="font-medium text-red-600 hover:underline ms-3">Delete</a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-3" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                                <label for="checkbox-table-search-3" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-6 py-4">3</td>
                        <td class="px-6 py-4">Wednesday</td>
                        <td class="px-6 py-4">2025-02-07</td> <!-- Sample Date -->
                        <td class="px-6 py-4">11:00 AM</td>
                        <td class="px-6 py-4">02:00 PM</td>
                        <td class="flex items-center px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="#" class="font-medium text-red-600 hover:underline ms-3">Delete</a>
                        </td>
                    </tr>
                    <!-- Repeat as necessary -->
                </tbody>
            </table>
        </div>

@endsection

