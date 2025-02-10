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

<div class="mt-6 grid grid-cols-3 gap-4 w-full">
    <!-- Card 1 -->
    <div class="flex items-center gap-4">
        <div class="p-4 bg-gray-600 rounded-lg shadow-lg w-full">
            <h3 class="text-lg font-bold text-white">Paracetamol</h3>
            <p class="text-gray-400">Description: This is for fever.</p>
            <p class="text-gray-400">Time: 02/19/2025 | 11:30 A.M</p>
        <a 
            href="javascript:void(0);" 
            class="text-blue-400 no-underline hover:underline hover:text-blue-500 text-l font-bold"
            onclick="openModal()">
            View Details
        </a>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <div class="p-4 bg-gray-600 rounded-lg shadow-lg w-full">
            <h3 class="text-lg font-bold text-white">Paracetamol</h3>
            <p class="text-gray-400">Description: This is for fever.</p>
            <p class="text-gray-400">Time: 02/19/2025 | 11:30 A.M</p>
            <a 
            href="javascript:void(0);" 
            class="text-blue-400 no-underline hover:underline hover:text-blue-500 text-l font-bold"
            onclick="openModal()">
            View Details
        </a>
        </div>
       
    </div>
    
</div>


<!-- Modal -->
<div id="detailsModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative space-y-2">
        <h2 class="text-lg font-bold mb-4">Prescription Details</h2>
        <p><strong>Doctor Name:</strong> Dr. John Smith</p>
        <p><strong>Appointment Date:</strong> 02/19/2025</p>
        <p><strong>Dosage:</strong> 500mg twice a day</p>
        <p><strong>Date Range:</strong> 02/19/2025 - 02/25/2025</p>
        <p><strong>Doctor's Note:</strong> Ensure proper rest and hydration.</p>
        
        <!-- Modal Buttons -->
        <div class="mt-6 flex justify-end gap-4">
            <button 
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none"
                onclick="closeModal()">
                Close
            </button>
            <button 
                class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-500 focus:outline-none">
                Contact Doctor
            </button>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function openModal() {
        document.getElementById('detailsModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }
</script>



@endsection