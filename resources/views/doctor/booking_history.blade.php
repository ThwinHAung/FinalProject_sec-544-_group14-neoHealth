@extends('layouts.doctor')

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
        <label for="patient-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Patient name</label>
        <input type="text" id="patient-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter doctor name" required>
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
                <th scope="col" class="px-6 py-3">Patient Name</th>
                <th scope="col" class="px-6 py-3">Appointment Date</th>
                <th scope="col" class="px-6 py-3">Appointment Time</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td></td>
                <td class="px-6 py-4">{{ $appointment->id }}</td>
                <td class="px-6 py-4">{{ $appointment->patient_name }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</td>
                <td class="px-6 py-4">{{ $appointment->description }}</td>
                <td class="px-6 py-4">{{ $appointment->status }}</td>
                <td class="px-6 py-4 flex items-center">
                    @if ($appointment->status !== 'Completed')
                        <a href="#" class="text-green-600 hover:underline ms-3"
                            onclick="updateStatus({{ $appointment->id }})">
                            Update
                        </a>
                        <a href="#" class="text-red-600 hover:underline ms-3"
                        onclick="cancelAppointment({{ $appointment->id }})">
                        Cancel
                        </a>
                    @else
                        <a href="#"
                            class="text-blue-600 hover:underline"
                            onclick="viewAppointmentDetails({{ $appointment->id }})"> 
                            View Details
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach


            <!-- Sample Appointment Data -->
            {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                <td class="px-6 py-4">Regular check-up</td>
                <td class="px-6 py-4">Scheduled</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" 
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline" 
                    onclick="showRescheduleModal(event)">
                    Reschedule
                    </a>
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Cancel</a> 
                    <a href="#" class="font-medium text-green-600 dark:text-green-500 hover:underline ms-3">Update</a>
                </td>  
                </td>
            </tr> --}}
        </tbody>
    </table>
</div>
<div id="appointment-detail-modal" tabindex="-1" aria-hidden="true" class="modal hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full overflow-y-auto overflow-x-hidden">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Appointment Details
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="appointment-detail-modal" onclick="closeModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only" onclick="closeModal()">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="space-y-2">
                    <p><strong>Appointment ID:</strong> <span id="appointment-id"></span></p>
                    <p><strong>Patient Name:</strong> <span id="patient_name"></span></p>
                    <p><strong>Description:</strong> <span id="appointment_description"></span></p>
                    <p><strong>Appointment Date:</strong> <span id="appointment-date"></span></p>
                    <p><strong>Appointment Time:</strong> <span id="appointment-time"></span></p>
                    <p><strong>Status:</strong> <span id="appointment-status"></span></p>
                    <p><strong>Notes:</strong> <span id="appointment_notes"></span></p>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="appointment-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
</div>


{{-- <div id="rescheduleModal" class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
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
</div> --}}

<div id="update-status-modal" tabindex="-1" aria-hidden="true" class="modal hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full overflow-y-auto overflow-x-hidden">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Appointment Completion
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only" onclick="closeModal()" >Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p>Please enter notes for patient</p>
                <textarea id="appointment_notes" class="w-full h-32 p-2 border border-gray-300 rounded" placeholder="Enter notes here..."></textarea>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="submitUpdateStatus()">Submit</button>
            </div>
        </div>
    </div>
</div>


<div id="bookingModal" class="modal fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
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
        <button id="cancelButton" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg transition" >Cancel</button>
        <button id="confirmButton" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">Confirm</button>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

function updateStatus(appointmentId) {
    console.log(appointmentId);

    // Show the modal
    document.getElementById("update-status-modal").classList.remove("hidden");

    // Store the appointmentId for later use
    window.currentAppointmentId = appointmentId;
}

function closeModal() {
    console.log("Closing modal");
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.classList.add('hidden');
    });
}


function submitUpdateStatus() {
    const notes = document.getElementById("appointment_notes").value;
    console.log("Notes:", notes);
    // Send the update request with the notes
    $.ajax({
        url: `/appointments/${window.currentAppointmentId}/update-status`,
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        contentType: "application/json",
        data: JSON.stringify({
            status: "Completed",
            notes: notes
        }),
        success: function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert("Failed to update appointment status.");
            }
        },
        error: function(error) {
            console.error("Error:", error);
        }
    });

    // Close the modal after submission
    closeModal();
}


function cancelAppointment(appointmentId) {
    if (!confirm("Are you sure you want to cancel this appointment?")) {
        return;
    }

    $.ajax({
        url: `/appointments/${appointmentId}/cancel`,  
        method: "DELETE",
        data: {
            _token: "{{ csrf_token() }}"  
        },
        success: function(response) {
            if (response.success) {
                alert("Appointment cancelled successfully.");
                location.reload();  
            } else {
                alert("Failed to cancel appointment.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", xhr.responseText);
        }
    });
}



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

  function viewAppointmentDetails(appointmentId) {

    $.ajax({
        url: `/appointments/${appointmentId}`,  
        method: 'GET',
        success: function(response) {
            if (response.success) {
                console.log(response.data.patient_name)
                // Populate modal with the fetched appointment data
                $('#appointment-id').text(response.data.id);
                $('#patient_name').text(response.data.patient_name);
                $('#appointment_description').text(response.data.description);
                $('#appointment-date').text(response.data.date);
                $('#appointment-time').text(response.data.start_time);
                $('#appointment-status').text(response.data.status);
                $('#appointment_notes').text(response.data.note);

                // Show the modal
                document.getElementById('appointment-detail-modal').classList.remove('hidden');
            } else {
                alert("Failed to load appointment details.");
            }
        },
        error: function(error) {
            console.log("Error:", error);
            alert("An error occurred while fetching appointment details.");
        }
    });
}

</script>
@endsection
