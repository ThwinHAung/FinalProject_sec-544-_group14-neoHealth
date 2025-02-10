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
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-actions" datepicker datepicker-buttons datepicker-autoselect-today
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex-shrink-0">
                            <button id="searchButton"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                                Search
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="results" class="mt-6 hidden   gap-4">
        <!-- Card 1 -->
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

    <!-- Modal -->
<div id="bookingModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-800 text-white rounded-lg p-6 shadow-lg w-96">
      <h3 class="text-lg font-bold">Confirm Booking</h3>
      <p class="text-gray-400 mt-2">Are you sure you want to book this time slot?</p>
      
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
        document.getElementById("searchButton").addEventListener("click", function(e) {
            e.preventDefault();
            const results = document.getElementById("results");
            results.classList.remove("hidden"); // Show the cards
        });

        $(document).ready(function () {
        // Functionality to select only one time option across all cards
        $("#results").on("click", "button.bg-gray-700", function () {
            console.log("Time button clicked:", $(this).text());

            // Deselect all previously selected time buttons
            $("button.bg-green-500").removeClass("bg-green-500").addClass("bg-gray-700");
            // Highlight the clicked button
            $(this).removeClass("bg-gray-700").addClass("bg-green-500");

            // Log the selected time
            console.log("Selected time across all cards:", $(this).text());
        });
        // Debugging: Log when jQuery is loaded
        console.log("jQuery is loaded and ready.");
        $("#results").on("click", ".bg-green-600", function () {
        console.log("Book Now button clicked");
        // Show the modal
        $("#bookingModal").removeClass("hidden").addClass("flex");
        });

    // Close the modal when "Cancel" is clicked
        $("#cancelButton").on("click", function () {
        console.log("Booking canceled");
        // Hide the modal
        $("#bookingModal").removeClass("flex").addClass("hidden");
        });

    // Confirm booking
        $("#confirmButton").on("click", function () {
            console.log("Booking confirmed");
            // Hide the modal
            $("#bookingModal").removeClass("flex").addClass("hidden");
            // You can add additional booking confirmation logic here
        });
    });
    document.getElementById('confirmButton').addEventListener('click', function() {
    alert('Booking Confirmed');
    window.location.reload();
  });

    </script>

@endsection
