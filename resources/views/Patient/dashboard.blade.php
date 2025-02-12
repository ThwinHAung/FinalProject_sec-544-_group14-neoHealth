@extends('layouts.patient')

@section('title', 'Patient Dashboard')

@section('header')
<h1>Patient Dashboard</h1>
@endsection
@section('content')



<h3 class="text-3xl font-semibold text-gray-800 dark:text-white">Hello
    @if (session()->has('patient'))
    {{ session('patient')->name }}!
@else
    Patient!
@endif
    , Welcome to Your Health Dashboard!</h3>
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
                        <a href="#" 
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline" 
                        onclick="showRescheduleModal(event)">
                        Reschedule
                        </a>
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
                        <a href="#" 
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline" 
                        onclick="showRescheduleModal(event)">
                        Reschedule
                        </a>
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
                        <a href="#" 
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline" 
                        onclick="showRescheduleModal(event)">
                        Reschedule
                        </a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Cancel</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



    <!-- Reschedule Modal -->
<div id="rescheduleModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg  p-6 relative">
        <h2 class="text-lg font-bold mb-4">Reschedule Appointment</h2>
        <div id="results" class="mt-6 gap-4">
            <div class="p-4 bg-gray-600 rounded-lg shadow-lg grid grid-cols-4 gap-3">
                    <div>
                        <button class="bg-gray-700 text-white rounded-lg px-4 p-4">
                            10:00 AM - 10:30 AM
                        </button>
                    </div>
                    <div>
                        <button class="bg-gray-700 text-white rounded-lg px-4 p-4" >
                            11:30 AM - 12:00 PM
                        </button>
                    </div>
                    <div>
                        <button class="bg-gray-700 text-white rounded-lg px-4 p-4" >
                            12:30 PM - 1:00 PM
                        </button>
                    </div>
                    <div>
                        <button class="bg-gray-700 text-white rounded-lg px-4 p-4" >
                            1:30 PM - 2:00 PM
                        </button>
                    </div>
                    <div>
                        <button class="bg-gray-700 text-white rounded-lg px-4 p-4" >
                            02:30 PM - 03:00 PM
                        </button>
                    </div>   
            </div>
    
            <div class="flex justify-end">
                <button class="mt-4 ms-auto bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    Book Now
                </button>
            </div>
                       
        </div>

        <!-- Close Button -->
        <button 
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" 
            onclick="closeRescheduleModal()">
            ✖
        </button>
    </div>
</div>

<div id="bookingModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-800 text-white rounded-lg p-6 shadow-lg w-96">
      <h3 class="text-lg font-bold">Confirm Rebooking</h3>
      <p class="text-gray-400 mt-2">Are you sure you want to rebook this time slot?</p>
      
         <textarea
        id="bookingDescription"
        class="w-full mt-4 bg-gray-700 text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
        placeholder="Add any additional details (optional)..."
        rows="3"
        > </textarea>
      <div class="mt-4 flex justify-end space-x-4">
        <button id="cancelButton" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg transition">Cancel</button>
        <button id="confirmButton" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">Confirm</button>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function showRescheduleModal(event) {
        event.preventDefault(); // Prevent link default action
        document.getElementById('rescheduleModal').classList.remove('hidden');
    }

    function closeRescheduleModal() {
        document.getElementById('rescheduleModal').classList.add('hidden');
    }

    $(document).ready(function () {
        // Functionality to select only one time option across all cards
        $("#results").on("click", "button.bg-gray-700", function () {
            console.log("Time button clicked:", $(this).text());

            // Deselect all previously selected time buttons
            $("button.bg-blue-600").removeClass("bg-blue-600").addClass("bg-gray-700");

            // Highlight the clicked button
            $(this).removeClass("bg-gray-700").addClass("bg-blue-600");

            
            console.log("Selected time across all cards:", $(this).text());
        });

        console.log("jQuery is loaded and ready.");
        $("#results").on("click", ".bg-green-600", function () {
        console.log("Book Now button clicked");
        // Show the modal
        $("#bookingModal").removeClass("hidden").addClass("flex");
        });


        $("#cancelButton").on("click", function () {
        console.log("Booking canceled");
        // Hide the modal
        $("#bookingModal").removeClass("flex").addClass("hidden");
        });

        $("#confirmButton").on("click", function () {
            console.log("Booking confirmed");
            // Hide the modal
            $("#bookingModal").removeClass("flex").addClass("hidden");
        });
    });
    document.getElementById('confirmButton').addEventListener('click', function() {
    alert('Booking Confirmed');
    window.location.reload();

  });
</script>
    
@endsection
