@extends('layouts.admin')

@section('title', 'Appointment Table')

@section('content')

<div class="mb-5 flex items-center justify-between space-x-4">
    <!-- First form input -->
    <div class="flex-grow">
        <label for="doctor-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Booking Id</label>
        <input type="text" id="doctor-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter booking Id" required>
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
                <th scope="col" class="px-6 py-3">Patient Name</th>
                <th scope="col" class="px-6 py-3">Doctor Name</th>
                <th scope="col" class="px-6 py-3">Appointment Date</th>
                <th scope="col" class="px-6 py-3">Appointment Time</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
     
    @foreach ($appointments as $appointment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                     data-id="{{ $appointment->id }}" 
                    data-doctorid="{{ $appointment->doctor_id }}" 
                    data-doctor="{{ $appointment->doctor_name }}" 
                    data-status="{{ $appointment->status }}"
                    data-date="{{ $appointment->time_slot_date }}" 
                    >
        <td class="w-4 p-4">
            <div class="flex items-center">
                {{-- <input id="checkbox-{{ $appointment->id }}" type="checkbox" 
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> --}}
        </div>
    </td>
    <td class="px-6 py-4">{{ $appointment->id }}</td>
    <td class="px-6 py-4">{{ $appointment->patient_name }}</td>
    <td class="px-6 py-4">{{ $appointment->doctor_name }}</td>
    <td class="px-6 py-4">{{ date('Y-m-d', strtotime($appointment->appointment_date)) }}</td>
    <td class="px-6 py-4">{{ date('h:i A', strtotime($appointment->start_time)) }}</td>
    <td class="px-6 py-4">{{ $appointment->status }}</td>
    @if ($appointment->status == 'cancelled')
        <td></td>
    @elseif($appointment->status == 'Booked')
    <td class="flex items-center px-6 py-4">
        <a href="#" 
           class="font-medium text-blue-600 dark:text-blue-500 hover:underline" 
           onclick="showRescheduleModal(event)" data-timeslot-id="{{ $appointment->time_slot_id }}">
           Reschedule
        </a>
        <a href="#" 
        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" 
        onclick="cancelAppointment(event)"
        data-appointment_id="{{ $appointment->id }}">
        Cancel
     </a>
    </td>
    @endif
</tr>
@endforeach
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

  <div id="rescheduleModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg  p-6 relative">
        <h2 class="text-lg font-bold mb-4">Reschedule Appointment</h2>
        <div id="results" class="mt-6 gap-4">
            <div class="p-4 bg-gray-600 rounded-lg shadow-lg grid grid-cols-4 gap-3" id="timeSlotsContainer">
                  
            </div>
            <div id="descriptionContainer">

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
      
      <div class="mt-4 flex justify-end space-x-4">
        <button id="cancelButton" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg transition">Cancel</button>
        <button id="confirmButton" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">Confirm</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Custom Script for Datepicker Initialization -->
  <script>
   function showRescheduleModal(event) {
    event.preventDefault(); 
    document.getElementById('rescheduleModal').classList.remove('hidden');

    // Retrieve selected row data
    let tr = event.target.closest('tr');
    selectedAppointmentId = tr.children[1].textContent;
    selectedDoctorId = tr.dataset.doctorid; // Ensure data-doctorid is set in the <tr>
    console.log("Doctor ID:", selectedDoctorId);

    let timestamp = tr.dataset.date;
    let dateStr = timestamp.split(" ")[0];
    let parts = dateStr.split("-");  
    selectedFormattedDate = `${parts[1]}/${parts[2]}/${parts[0]}`;  
    console.log("Formatted Date:", selectedFormattedDate);

    if (!selectedDoctorId) {
        alert("Doctor ID is missing. Cannot fetch available time slots.");
        return;
    }

    // Fetch all available time slots for the selected doctor
    $.ajax({
        url: "{{ route('admin.getDoctorAvailableSlots') }}", // New route for fetching all slots
        method: "GET",
        data: {
            doctor_id: selectedDoctorId,
        },
        success: function(response) {
            $('#timeSlotsContainer').empty(); // Clear previous slots
            $('#descriptionContainer').empty(); // Clear previous description field
            console.log("Available slots:", response);

            if (response.length === 0) {
                $('#timeSlotsContainer').html('<p class="text-gray-400">No available slots found.</p>');
            } else {
                response.forEach(slot => {
                    let timeSlotHtml = `
                        <button class="bg-gray-700 text-white rounded-lg px-4 py-2 my-1 block w-full text-center"
                            data-timeslot-id="${slot.id}">
                            ${slot.start_time} - ${slot.end_time}
                        </button>
                    `;                  
                    $('#timeSlotsContainer').append(timeSlotHtml); 
                });

                let descriptionHtml = `
                    <div class="mt-5">
                        <textarea name="description" id="description" rows="4" 
                            class="block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Any words for your Doctor? (optional)..."></textarea>
                    </div>
                `;
                $('#descriptionContainer').append(descriptionHtml);
            }
        },
        error: function(error) {
            console.error("Error fetching slots:", error);
            alert("An error occurred while fetching available slots.");
        }
    });
}

    function closeRescheduleModal() {
        document.getElementById('rescheduleModal').classList.add('hidden');
    }
    //   // Wait for the DOM to load before initializing Flowbite
    //   document.addEventListener('DOMContentLoaded', function () {
    //       const startDatePicker = new Datepicker(document.getElementById('datepicker-range-start'), {
    //           format: 'mm/dd/yyyy', // you can change the date format as needed
    //       });

    //       const endDatePicker = new Datepicker(document.getElementById('datepicker-range-end'), {
    //           format: 'mm/dd/yyyy', // you can change the date format as needed
    //       });
    //   });

      $(document).ready(function () {
        // Functionality to select only one time option across all cards
        $("#results").on("click", "button.bg-gray-700", function () {
            console.log("Time button clicked:", $(this).text());
            // Deselect all previously selected time buttons
            $("button.bg-blue-600").removeClass("bg-blue-600").addClass("bg-gray-700");

            // Highlight the clicked button
            $(this).removeClass("bg-gray-700").addClass("bg-blue-600");
            selectedTimeSlotId=$(this).data('timeslot-id');
            console.log("Selected time across all cards:", $(this).text());
        });
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

      document.getElementById('confirmButton').addEventListener('click', function () {
    let description = $('#description').val();
    let appointmentId = selectedAppointmentId;
    let time_slot_id = selectedTimeSlotId;

    console.log("Description:", description);
    console.log("Appointment ID:", appointmentId);
    console.log("Time Slot ID:", time_slot_id);

    if (!time_slot_id || !appointmentId) {
        alert("Please complete all fields.");
        return;
    }

    $.ajax({
        url: `/admin_dashboard/book-appointment/${appointmentId}`,  // Use dynamic route
        method: 'PUT',
        data: {
            _token: "{{ csrf_token() }}",
            description: description,
            time_slot_id: time_slot_id,
        },
        success: function (response) {
            alert('Booking Confirmed');
            window.location.reload();
        },
        error: function (error) {
            console.error("Error booking appointment:", error);
            alert("An error occurred while booking the appointment.");
        }
    });
});

function cancelAppointment(event) {
    event.preventDefault(); // Prevent link default behavior
    let appointmentId = event.target.dataset.appointment_id; // Get the appointment ID
    console.log(appointmentId);
    if (!confirm('Are you sure you want to cancel this appointment?')) {
        return; // If user cancels, stop further execution
    }

    // Send PUT request to update the status of the appointment
    fetch(`/appointments/${appointmentId}/cancel`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}', 
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        alert(data.message); // Show the success message
        location.reload(); // Reload the page to reflect the changes
    })
    .catch(error => console.error('Error:', error)); // Handle errors
};

  </script>

@endsection