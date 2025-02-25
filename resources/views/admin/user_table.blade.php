@extends('layouts.admin')

@section('title', 'Patient List')

@section('content')

<div class="mb-5 flex items-center space-x-4 justify-between">
    <!-- Search Form -->
    <div class="flex-grow max-w-xs">
        <form method="GET" action="{{ route('admin.patient') }}" class="flex items-end space-x-2">
            <div class="flex-grow">
                <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by Patient ID or Name</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter patient ID or name">
            </div>
        </form>
    </div>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table id="patient-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="id"><strong>ID</strong></th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="name"><strong>Name</strong></th>
                <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="age"><strong>Age</strong></th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Phone Number</th>
                <th scope="col" class="px-6 py-3">Address</th>
                <th scope="col" class="px-6 py-3">Emergency Address</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($patients))
            @foreach ($patients as $patient)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-{{ $patient->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-{{ $patient->id }}" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">{{ $patient->id }}</td>
                <td class="px-6 py-4">{{ $patient->name }}</td>
                <td class="px-6 py-4">{{ $patient->age }}</td>
                <td class="px-6 py-4">{{ $patient->email }}</td>
                <td class="px-6 py-4">{{ $patient->phone_number }}</td>
                <td class="px-6 py-4">{{ $patient->address }}</td>
                <td class="px-6 py-4">{{ $patient->emergency_address }}</td>
                <td class="flex items-center px-6 py-4">
                    <form action="{{ route('admin.patient.edit', $patient->id) }}" method="GET" class="inline-block">
                        @csrf
                        <button type="button" 
                        class="edit-button font-medium text-blue-600 dark:text-blue-500 hover:underline" 
                        data-id="{{ $patient->id }}" 
                        data-name="{{ $patient->name }}" 
                        data-age="{{ $patient->age }}" 
                        data-email="{{ $patient->email }}" 
                        data-phone="{{ $patient->phone_number }}" 
                        data-address="{{ $patient->address }}" 
                        data-emergency_address="{{ $patient->emergency_address }}" 
                        data-modal-target="edit-patient-modal" 
                        data-modal-toggle="edit-patient-modal">
                        Edit
                    </button>
                    
                    </form>
                    <form action="{{ route('admin.patient.remove', $patient->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach       
            @endif
        </tbody>
    </table>
</div>

<div id="edit-patient-modal" tabindex="-1" aria-hidden="true" 
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Patient Profile
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    data-modal-hide="edit-patient-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ route('admin.patient.update', 'patient_id') }}" method="POST" id="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="patient_id" id="edit-patient-id">
                    
                    <div>
                        <label for="edit-full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input type="text" name="full-name" id="edit-full-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="edit-age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                        <input type="text" name="age" id="edit-age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="edit-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="edit-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="edit-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="tel" name="phone" id="edit-phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>

                    <div>
                        <label for="edit-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="address" id="edit-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>

                    <div>
                        <label for="edit-emergency_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Emergency Address</label>
                        <input type="text" name="emergency_address" id="edit-emergency_address" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update
                        </button>
                    </div>
                </form>
            </div>
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
            return isNaN(v1) || isNaN(v2) ? v1.localeCompare(v2) : v1 - v2;
        };
    };

    document.querySelectorAll('th[data-sort]').forEach(th => {
        th.addEventListener('click', function() {
            const table = th.closest('table');
            Array.from(table.querySelectorAll('tbody > tr'))
                .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                .forEach(tr => table.querySelector('tbody').appendChild(tr));
        });
    });

    const searchInput = document.getElementById('search');
    if(searchInput){
        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#patient-table tbody tr');
            rows.forEach(row => {
                const id = row.children[1].innerText.toLowerCase();
                const name = row.children[2].innerText.toLowerCase();
                row.style.display = (id.includes(filter) || name.includes(filter)) ? '' : 'none';
            });
        });
    }

    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const age = this.getAttribute('data-age');
            const email = this.getAttribute('data-email');
            const phone = this.getAttribute('data-phone');
            const address = this.getAttribute('data-address');
            const emergencyAddress = this.getAttribute('data-emergency_address');

            document.getElementById('edit-patient-id').value = id;
            document.getElementById('edit-full-name').value = name;
            document.getElementById('edit-age').value = age;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-phone').value = phone;
            document.getElementById('edit-address').value = address;
            document.getElementById('edit-emergency_address').value = emergencyAddress;
            document.getElementById('edit-form').action = `/admin_dashboard/user_table/${id}`;
        });
    });
    
});
</script>

@endsection
