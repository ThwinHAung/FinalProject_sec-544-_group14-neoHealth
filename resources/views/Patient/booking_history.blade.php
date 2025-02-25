@extends('layouts.patient')

@section('title', 'Appointment History')
@section('header')
<h1>Booking History</h1>
@endsection
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
            <!-- Sample Appointment Data 1 -->
            @foreach($appointments as $appointment)
<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
    <td class="w-4 p-4">
        <div class="flex items-center">
            <input id="checkbox-table-search-{{ $appointment->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-table-search-{{ $appointment->id }}" class="sr-only">checkbox</label>
        </div>
    </td>
    <td class="px-6 py-4">{{ $appointment->id }}</td>
    <td class="px-6 py-4">{{ $appointment->doctor_name }}</td>
    <td class="px-6 py-4">{{ $appointment->specialty }}</td>
    <td class="px-6 py-4">{{ $appointment->appointment_date }}</td>
    <td class="px-6 py-4">{{ $appointment->start_time }}</td>
    <td class="px-6 py-4">{{ $appointment->status }}</td>
    @if($appointment->status === 'Completed')
    <td class="flex items-center px-6 py-4">
        <a href="#" class="viewDetailsBtn font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="viewDetails({{ $appointment->id }})"> 
        View Details</a>
    </td>
    @else
    <td></td>
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

  <div id="detailsModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-gray-800 bg-opacity-50">
    <div class="relative w-full max-w-2xl bg-white rounded-lg shadow-lg p-6 space-y-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Booking Details
                </h3>
                <button id="closeModalBtn" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detailsModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4">
                <div class="space-y-2">
                    <p><strong>Doctor:</strong> <span id="modalDoctor"></span></p>
                    <p><strong>Specialty:</strong> <span id="modalSpecialty"></span></p>
                    <p><strong>Date:</strong> <span id="modalDate"></span></p>
                    <p><strong>Time:</strong> <span id="modalTime"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                    <p><strong>Medicine Prescription:</strong></p>
                    <ul id="modalMeds" class="list-disc pl-5"></ul>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button id="closeModalBtn" type="button" class="mt-4 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    Close
                </button>
            </div>
        </div>
    </div>
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



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    const viewDetailsBtns = document.querySelectorAll('.viewDetailsBtn');
    const modal = document.getElementById('detailsModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    
    // Function to open the modal and populate it with data
    viewDetailsBtns.forEach(btn => {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            
            // Get data attributes from the clicked button
            const doctor = btn.getAttribute('data-doctor');
            const specialty = btn.getAttribute('data-specialty');
            const date = btn.getAttribute('data-date');
            const time = btn.getAttribute('data-time');
            const status = btn.getAttribute('data-status');
            const meds = btn.getAttribute('data-meds').split(',');

            // Populate modal with the retrieved data
            document.getElementById('modalDoctor').textContent = doctor;
            document.getElementById('modalSpecialty').textContent = specialty;
            document.getElementById('modalDate').textContent = date;
            document.getElementById('modalTime').textContent = time;
            document.getElementById('modalStatus').textContent = status;

            // Populate the medicine list
            const medsList = document.getElementById('modalMeds');
            medsList.innerHTML = ''; // Clear previous list
            meds.forEach(med => {
                const li = document.createElement('li');
                li.textContent = med.trim();
                medsList.appendChild(li);
            });

            // Show the modal
            modal.classList.remove('hidden');
        });
    });

    // Close modal when "Close" button is clicked
    closeModalBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    // Close modal when clicking outside the modal (optional)
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });

    function viewDetails(appointmentId){
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

    function closeModal() {
    console.log("Closing modal");
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.classList.add('hidden');
    });
}


  </script>

@endsection