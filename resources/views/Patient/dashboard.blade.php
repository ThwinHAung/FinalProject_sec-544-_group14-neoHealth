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
    {{-- {{$appointments}} --}}
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
                <tbody>

                    @foreach($appointments as $appointment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                    data-id="{{ $appointment->id }}" 
                    data-doctorid="{{ $appointment->doctor_id }}" 
                    data-doctor="{{ $appointment->doctor_name }}" 
                    data-date="{{ $appointment->time_slot_date }}" 
                    data-time="{{ $appointment->start_time }}" 
                    data-status="{{ $appointment->status }}"
                    >
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $appointment->id }}</td>
                        <td class="px-6 py-4">{{ $appointment->doctor_name }}</td>
                        <td class="px-6 py-4">{{ $appointment->specialty }}</td>
                        <td class="px-6 py-4">{{ $appointment->time_slot_date }}</td>
                        <td class="px-6 py-4">{{ $appointment->start_time }}</td>
                        <td class="px-6 py-4">{{ $appointment->status }}</td>
                        <td class="flex items-center px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="showRescheduleModal(event)" data-timeslot-id="{{ $appointment->time_slot_id }}">
                                Reschedule
                            </a>
                            <a href="#" 
                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" 
                            onclick="cancelAppointment(event)"
                            data-appointment_id="{{ $appointment->id }}">
                            Cancel
                         </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
                {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                </tr> --}}
            </tbody>
        </table>
    </div>



    <!-- Reschedule Modal -->
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

let selectedSpecialty, selectedDoctorId, selectedFormattedDate, selectedTimeSlotId, selectedAppointmentId; 

    function showRescheduleModal(event) {
        event.preventDefault(); // Prevent link default action
        document.getElementById('rescheduleModal').classList.remove('hidden');
        selectedTimeSlotId = event.target.dataset.timeslotId;
        console.log(selectedTimeSlotId); // 
            let tr = event.target.closest('tr');
            selectedAppointmentId = tr.children[1].textContent;
            console.log(selectedAppointmentId);
            selectedSpecialty = tr.children[3].textContent;
            selectedDoctorId = tr.dataset.doctorid;
            console.log(selectedDoctorId);
            let timestamp = tr.dataset.date;
            let dateStr = timestamp.split(" ")[0]
            let parts = dateStr.split("-");  
            selectedFormattedDate = `${parts[1]}/${parts[2]}/${parts[0]}`;  
           console.log(selectedFormattedDate);

            if (!selectedSpecialty || !selectedDoctorId || !selectedFormattedDate) {
                alert("Please select all fields before searching.");
                return;
            }

            $.ajax({
                url: "{{ route('patient.getAvailableSlots') }}",
                method: "GET",
                data: {
                    specialty: selectedSpecialty,
                    doctor_id: selectedDoctorId,
                    date: selectedFormattedDate
                },
                success: function(response) {
                    $('#timeSlotsContainer').empty(); // Clear previous slots
                    $('#descriptionContainer').empty(); // Clear previous slots
                    console.log("Available slots:", response);
                    if (response.length === 0) {
                        $('#timeSlotsContainer').html('<p class="text-gray-400">No available slots found.</p>');
                        $('#descriptionContainer').empty();
                    } else {
                        console.log('what')
                        console.log(response)
                        response.forEach(slot => {
                            let timeSlotHtml = `
                                <button class="bg-gray-700 text-white rounded-lg px-4 p-4" data-timeslot-id="${slot.id}" >
                                    ${slot.start_time} - ${slot.end_time}
                                </button>
                            `;                  
                            $('#timeSlotsContainer').append(timeSlotHtml); 
                        });
                        let description = `
                            <div class="mt-5">
                            <textarea name="description" id="description" rows="4" 
                                class="block w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Any words for your Doctor? (optional)..."></textarea> </div>
                            `;
                            $('#descriptionContainer').append(description);
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
    document.getElementById('confirmButton').addEventListener('click', function() {
    
        let description = $('#description').val();
        console.log(description);
        let appointmentId = selectedAppointmentId;
        console.log(appointmentId);
        let time_slot_id = selectedTimeSlotId;
        console.log(time_slot_id);
        if (!time_slot_id) {
            alert("Please complete all fields.");
            return;
        }
        $.ajax({
            url: "{{ route('patient.bookAppointment') }}",  
            method: 'PUT',
            data: {
                _token: "{{ csrf_token() }}",
                description: description,
                appointment_id : appointmentId,
                time_slot_id: time_slot_id,
            },
            success: function (response) {
                alert('Booking Confirmed');
                window.location.reload();
            },
            error: function (error) {
                console.error("Error booking appointment:", error);
                alert("An error occurred while booking the appointment.".error);
            }
        });
        // window.location.reload();
    });

    function cancelAppointment(event) {
        event.preventDefault(); // Prevent link default behavior
        let appointmentId = event.target.dataset.appointment_id; // Get the appointment ID
        console.log(appointmentId);
        if (!confirm('Are you sure you want to cancel this appointment?')) {
            return; // If user cancels, stop further execution
        }

        // Send DELETE request to delete the appointment
        fetch(`/appointments/${appointmentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token
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
