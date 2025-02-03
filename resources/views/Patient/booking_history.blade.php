@extends('layouts.patient')

@section('title', 'Appointment History')
@section('content')
<div class="mb-5 flex items-center justify-between space-x-4">
    <!-- First form input -->
    <div class="flex-grow">
        <label for="booking_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Booking Id</label>
        <input type="text" id="booking_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter booking Id" required>
    </div>

    <!-- Second form input -->
    <div class="flex-grow">
        <label for="doctor-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor name</label>
        <input type="text" id="doctor-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter doctor name" required>
    </div>

    <!-- Date range picker -->
    <div id="date-range-picker" class="flex items-center space-x-4 mt-7">
        <div class="relative">
            <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ps-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select start date">
        </div>
        <span class="text-gray-500">to</span>
        <div class="relative">
            <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ps-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select end date">
        </div>
    </div>

    <!-- Search button aligned to the right -->
    <div class="ml-auto mt-7">
        <button type="button" class="px-6 py-3.5 text-base font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</div>




<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                <th scope="col" class="px-6 py-3">Speciality</th>
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
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
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
                <td class="px-6 py-4">2025-02-06</td>
                <td class="px-6 py-4">02:00 PM</td>
                <td class="px-6 py-4">Completed</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
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
                <td class="px-6 py-4">2025-02-07</td>
                <td class="px-6 py-4">09:30 AM</td>
                <td class="px-6 py-4">Canceled</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
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
                <td class="px-6 py-4">Dr. Sarah Lee</td>
                <td class="px-6 py-4">Pediatrics</td>
                <td class="px-6 py-4">2025-02-08</td>
                <td class="px-6 py-4">11:00 AM</td>
                <td class="px-6 py-4">Scheduled</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
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
                <td class="px-6 py-4">Dr. Michael Scott</td>
                <td class="px-6 py-4">Neurology</td>
                <td class="px-6 py-4">2025-02-09</td>
                <td class="px-6 py-4">12:30 PM</td>
                <td class="px-6 py-4">Completed</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-6" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-6" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">6</td>
                <td class="px-6 py-4">Dr. Olivia Brown</td>
                <td class="px-6 py-4">Gastroenterology</td>
                <td class="px-6 py-4">2025-02-10</td>
                <td class="px-6 py-4">03:00 PM</td>
                <td class="px-6 py-4">Scheduled</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-7" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-7" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">7</td>
                <td class="px-6 py-4">Dr. Linda Green</td>
                <td class="px-6 py-4">Orthopedics</td>
                <td class="px-6 py-4">2025-02-11</td>
                <td class="px-6 py-4">04:00 PM</td>
                <td class="px-6 py-4">Completed</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-8" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-8" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">8</td>
                <td class="px-6 py-4">Dr. Nathan White</td>
                <td class="px-6 py-4">Neurosurgery</td>
                <td class="px-6 py-4">2025-02-12</td>
                <td class="px-6 py-4">05:30 PM</td>
                <td class="px-6 py-4">Scheduled</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-9" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-9" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">9</td>
                <td class="px-6 py-4">Dr. Karen Black</td>
                <td class="px-6 py-4">Endocrinology</td>
                <td class="px-6 py-4">2025-02-13</td>
                <td class="px-6 py-4">06:00 PM</td>
                <td class="px-6 py-4">Canceled</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-10" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-10" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">10</td>
                <td class="px-6 py-4">Dr. Robert Brown</td>
                <td class="px-6 py-4">Hematology</td>
                <td class="px-6 py-4">2025-02-14</td>
                <td class="px-6 py-4">07:00 PM</td>
                <td class="px-6 py-4">Scheduled</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>



<div class="flex flex-col items-end p-8">
    <!-- Help text -->
    <span class="text-sm text-gray-700 dark:text-gray-400">
        Showing <span class="font-semibold text-gray-900 dark:text-white">1</span> to <span class="font-semibold text-gray-900 dark:text-white">10</span> of <span class="font-semibold text-gray-900 dark:text-white">100</span> Entries
    </span>
    <!-- Buttons -->
    <div class="inline-flex mt-2 xs:mt-0">
        <button class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Prev
        </button>
        <button class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Next
        </button>
    </div>
  </div>

@endsection