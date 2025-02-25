@extends('layouts.doctor')

@section('title', 'Medicine Prescription')

@section('content')

<!-- Button to trigger the modal -->
<div class="mb-5 flex items-center space-x-4 justify-between">
    <!-- Search Form -->
    <div class="flex-grow max-w-xs">
        <form method="GET" action="{{ route('doctor.prescription') }}" class="flex items-end space-x-2">
            <div class="flex-grow">
                <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by Patient name or Appointment Id</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter Patient name or Appointment ID">
            </div>
            {{-- <button type="submit"
                class="px-4 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Search
            </button> --}}
        </form>
    </div>

    <!-- Create Button -->
    <div>
        <button data-modal-target="prescription-modal" data-modal-toggle="prescription-modal" class="px-4 py-2 text-white bg-blue-700 hover:bg-blue-800 rounded-lg mb-5">Create Prescription</button>
    </div>
</div>


<!-- Modal content -->
<div id="prescription-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create Medicine Prescription
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="prescription-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" action="{{ route('doctor.store_prescription') }}" id="prescription-form" class="space-y-4">
                    @csrf
                    <div>
                        <label for="appointment-id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment ID</label>
                        <select name="appointment_id" id="appointment-id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                            <option disabled selected>Select an appointment ID</option>
                            @foreach($appointments as $appointment)
                                <option value="{{ $appointment->appointment_id }}" {{ old('appointment_id') == $appointment->appointment_id ? 'selected' : '' }}>Appointment {{ $appointment->appointment_id }}</option>
                            @endforeach
                        </select>
                        @error('appointment_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="medicine-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medicine Name</label>
                        <input type="text" name="medicine_name" id="medicine-name" value="{{ old('medicine_name') }}" placeholder="Enter medicine name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        @error('medicine_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" name="description" id="description" value="{{ old('description') }}" placeholder="Enter description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="dosage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dosage</label>
                        <input type="text" name="dosage" id="dosage" value="{{ old('dosage') }}" placeholder="Enter dosage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        @error('dosage')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="start-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                        <input type="date" name="start_date" id="start-date" value="{{ old('start_date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        @error('start_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="end-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                        <input type="date" name="end_date" id="end-date" value="{{ old('end_date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        @error('end_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Note</label>
                        <textarea name="note" id="note" placeholder="Enter any notes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('note') }}</textarea>
                        @error('note')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-between">
                        <button type="reset" class="w-1/2 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Clear</button>
                        <button type="submit" class="w-1/2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Prescription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Prescription Table -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="prescription-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="id"><strong>ID</strong></th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="patient_name"><strong>Patient Name</strong></th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="medicine_name"><strong>Medicine Name</strong></th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="dosage"><strong>Dosage</strong></th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="date_range"><strong>Date Range</strong></th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="appointment_date"><strong>Appointment Date</strong></th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prescriptions as $prescription)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-{{ $prescription->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-{{ $prescription->id }}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $prescription->id }}</td>
                    <td class="px-6 py-4">{{ $prescription->patient_name }}</td>
                    <td class="px-6 py-4">{{ $prescription->medicine_name }}</td>
                    <td class="px-6 py-4">{{ $prescription->dosage }}</td>
                    <td class="px-6 py-4">{{ date('Y-m-d', strtotime($prescription->start_date)) }} to {{ date('Y-m-d', strtotime($prescription->end_date)) }}</td>
                    <td class="px-6 py-4">{{ date('Y-m-d H:i', strtotime($prescription->appointment_date)) }}</td>
                    <td class="flex items-center px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline view-details" 
                           data-id="{{ $prescription->id }}"
                           data-patient_name="{{ $prescription->patient_name }}"
                           data-appointment-date="{{ date('Y-m-d H:i', strtotime($prescription->appointment_date)) }}"
                           data-dosage="{{ $prescription->dosage }}"
                           data-start-date="{{ date('Y-m-d', strtotime($prescription->start_date)) }}"
                           data-end-date="{{ date('Y-m-d', strtotime($prescription->end_date)) }}"
                           data-note="{{ $prescription->note }}"
                           data-description="{{ $prescription->description }}"
                           onclick="openDetailsModal(this)">View Details</a>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="8" class="px-6 py-4 text-center">No prescriptions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Details Modal -->
<div id="detailsModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/3 p-6 relative space-y-2">
        <h2 class="text-lg font-bold mb-4">Prescription Details</h2>
        <p><strong>Patient Name:</strong> <span id="detail-patient-name"></span></p>
        <p><strong>Appointment Date:</strong> <span id="detail-appointment-date"></span></p>
        <p><strong>Dosage:</strong> <span id="detail-dosage"></span></p>
        <p><strong>Date Range:</strong> <span id="detail-date-range"></span></p>
        <p><strong>Description:</strong> <span id="detail-description"></span></p>
        <p><strong>Doctor's Note:</strong> <span id="detail-note"></span></p>
        <div class="mt-6 flex justify-end gap-4">
            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none" onclick="closeModal()">Close</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

    const comparer = function(idx, asc) {
        return function(a, b) {
            const v1 = getCellValue(asc ? a : b, idx);
            const v2 = getCellValue(asc ? b : a, idx);
            // Use numeric comparison if possible
            return isNaN(v1) || isNaN(v2) ? v1.localeCompare(v2) : v1 - v2;
        };
    };

    // Enable sorting on headers with data-sort attribute
    document.querySelectorAll('th[data-sort]').forEach(th => {
        th.addEventListener('click', function() {
            const table = th.closest('table');
            Array.from(table.querySelectorAll('tbody > tr'))
                .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                .forEach(tr => table.querySelector('tbody').appendChild(tr) );
        });
    });

    // Simple client-side search filter (optional, if you want additional filtering besides the form)
    const searchInput = document.getElementById('search');
    if(searchInput){
        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#prescription-table tbody tr');
            rows.forEach(row => {
                const id = row.children[1].innerText.toLowerCase();
                const name = row.children[2].innerText.toLowerCase();
                row.style.display = (id.includes(filter) || name.includes(filter)) ? '' : 'none';
            });
        });
    }

    window.openDetailsModal = function(element) {    
            const modal = document.getElementById('detailsModal');
            document.getElementById('detail-patient-name').textContent = element.getAttribute('data-patient_name');
            document.getElementById('detail-appointment-date').textContent = element.getAttribute('data-appointment-date');
            document.getElementById('detail-dosage').textContent = element.getAttribute('data-dosage');
            document.getElementById('detail-date-range').textContent = `${element.getAttribute('data-start-date')} - ${element.getAttribute('data-end-date')}`;
            document.getElementById('detail-description').textContent = element.getAttribute('data-description');
            document.getElementById('detail-note').textContent = element.getAttribute('data-note') || 'N/A';
            modal.classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('detailsModal').classList.add('hidden');
        }

        // Adding close modal event listener
        function closeModal() {
            const modal = document.getElementById('detailsModal');
            modal.classList.add('hidden');
        }

        window.closeModal = function() {
            const modal = document.getElementById('detailsModal');
            modal.classList.add('hidden');
        }

        const closeButton = document.querySelector('#detailsModal .mt-6 .flex button');
        if (closeButton) {
            closeButton.addEventListener('click', closeModal);
        }

        const modal = document.getElementById('detailsModal');
        modal.addEventListener('click', function(event) {
            if (event.target === modal) { // Only close if the user clicks outside the modal content
                closeModal();
            }
        });
});

</script>

@endsection