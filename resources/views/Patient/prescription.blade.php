@extends('layouts.patient')

@section('title', 'Appointment History')
@section('header')
<h1>Medicine Prescription</h1>
@endsection
@section('content')

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

<!-- Container for all prescriptions -->
<div id="appointmentContainer" class="mt-6 grid grid-cols-3 gap-4 w-full"></div>

<!-- Modal -->
<div id="detailsModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative space-y-2">
        <h2 class="text-lg font-bold mb-4">Prescription Details</h2>
        <p class="doctor-name"><strong>Doctor Name:</strong> </p>
        <p class="appointment-date"><strong>Appointment Date:</strong> </p>
        <p class="dosage"><strong>Dosage:</strong> </p>
        <p class="date-range"><strong>Date Range:</strong> </p>
        <p class="doctor-note"><strong>Doctor's Note:</strong> </p>
        <button class="absolute top-2 right-2 p-2 text-gray-500" onclick="closeModal()">X</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function openModal(id) {
        document.getElementById('detailsModal').classList.remove('hidden');
        fetch(`/patient_dashboard/prescription/${id}`)
            .then(response => response.json())
            .then(data => {
                document.querySelector('#detailsModal .doctor-name').textContent = `Doctor Name: ${data.doctor_name}`;
                document.querySelector('#detailsModal .appointment-date').textContent = `Appointment Date: ${data.appointment_date}`;
                document.querySelector('#detailsModal .dosage').textContent = `Dosage: ${data.dosage}`;
                document.querySelector('#detailsModal .date-range').textContent = `Date Range: ${data.start_date} - ${data.end_date}`;
                document.querySelector('#detailsModal .doctor-note').textContent = `Doctor's Note: ${data.note}`;
            })
            .catch(error => console.error('Error fetching prescription details:', error));
    }

    function closeModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }

    function loadAppointments(date) {
        $.ajax({
            url: "{{ route('patient.searchAppointments') }}",
            method: "GET",
            data: { date: date },
            success: function (response) {
                $("#appointmentContainer").empty();
                if (response.length === 0) {
                    $("#appointmentContainer").html('<p class="text-gray-400">No Prescription found.</p>');
                } else {
                    response.forEach(appointment => {
                        let appointmentCard = `
                            <div class="p-4 bg-gray-600 rounded-lg shadow-lg w-full">
                                <h3 class="text-lg font-bold text-white">${appointment.medicine_name}</h3>
                                <p class="text-gray-400">Description: ${appointment.prescriptions}</p>
                                <a href="javascript:void(0);" class="text-blue-400 no-underline hover:underline hover:text-blue-500 text-l font-bold" onclick="openModal(${appointment.id})">
                                    View Details
                                </a>
                            </div>`;
                        $("#appointmentContainer").append(appointmentCard);
                    });
                }
            },
            error: function (error) {
                console.error("Error fetching appointments:", error);
                alert("An error occurred while fetching appointments.");
            }
        });
    }

    $(document).ready(function () {
        // Load today's appointments on page load
        let today = new Date().toISOString().split('T')[0]; // YYYY-MM-DD format
        loadAppointments(today);

        $("#searchButton").click(function () {
            let selectedDate = $("#datepicker-actions").val(); // MM/DD/YYYY
            if (!selectedDate) {
                alert("Please select a date!");
                return;
            }
            let dateParts = selectedDate.split("/");
            let formattedDate = `${dateParts[2]}-${dateParts[0]}-${dateParts[1]}`; // YYYY-MM-DD
            loadAppointments(formattedDate);
        });
    });
</script>

@endsection