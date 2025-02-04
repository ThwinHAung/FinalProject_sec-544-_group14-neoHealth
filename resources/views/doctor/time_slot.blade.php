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
                <select id="start-time" name="start-time" class="block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option disabled selected>Select Start Time</option>
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                    @endfor
                </select>
            </div>

            <!-- Third Column: End Time Dropdown (24-Hour Format) -->
            <div class="col-span-3">
                <label for="end-time" class="block text-lg text-gray-700 dark:text-gray-300">End Time</label>
                <select id="end-time" name="end-time" class="block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option disabled selected>Select End Time</option>
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                    @endfor
                </select>
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
                    <tr class="bg-white border-b hover:bg-gray-50">
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
                    <tr class="bg-white border-b hover:bg-gray-50">
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
                    <tr class="bg-white border-b hover:bg-gray-50">
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

