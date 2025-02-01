@extends('layouts.patient')

@section('title', 'Patient Dashboard')

@section('content')
<h3 class="text-3xl font-semibold text-gray-800 dark:text-white">Hello John, Welcome to Your Health Dashboard!</h3>
<p class="mt-4 text-gray-600 dark:text-gray-300">We’re excited to help you stay on top of your health. Here’s a quick overview of your appointments and medical details.</p>

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
                    <th scope="col" class="px-6 py-3">Doctor Name</th>
                    <th scope="col" class="px-6 py-3">Specialty</th>
                    <th scope="col" class="px-6 py-3">Appointment Date</th>
                    <th scope="col" class="px-6 py-3">Appointment Time</th>
                    <th scope="col" class="px-6 py-3">Status</th>
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
                    <td class="px-6 py-4">Dr. John Smith</td>
                    <td class="px-6 py-4">Cardiology</td>
                    <td class="px-6 py-4">2025-02-05</td>
                    <td class="px-6 py-4">10:00 AM</td>
                    <td class="px-6 py-4">Scheduled</td>
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
                    <td class="px-6 py-4">Dr. Emma Johnson</td>
                    <td class="px-6 py-4">Dermatology</td>
                    <td class="px-6 py-4">2025-02-05</td>
                    <td class="px-6 py-4">02:00 PM</td>
                    <td class="px-6 py-4">Scheduled</td>
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
                    <td class="px-6 py-4">Dr. Robert Williams</td>
                    <td class="px-6 py-4">Orthopedics</td>
                    <td class="px-6 py-4">2025-02-05</td>
                    <td class="px-6 py-4">03:30 PM</td>
                    <td class="px-6 py-4">Scheduled</td>
                    <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Reschedule</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Cancel</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
@endsection
