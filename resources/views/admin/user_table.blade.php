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
            </tr>
        </thead>
        <tbody>
            @if (isset($patients))
            @foreach ($patients as $patient)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-{{ $patient->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </td>
                <td class="px-6 py-4">{{ $patient->id }}</td>
                <td class="px-6 py-4">{{ $patient->name }}</td>
                <td class="px-6 py-4">{{ $patient->age }}</td>
                <td class="px-6 py-4">{{ $patient->email }}</td>
                <td class="px-6 py-4">{{ $patient->phone_number }}</td>
                <td class="px-6 py-4">{{ $patient->address }}</td>
                <td class="px-6 py-4">{{ $patient->emergency_address }}</td>
            </tr>
            @endforeach       
            @endif
        </tbody>
    </table>
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
});
</script>

@endsection
