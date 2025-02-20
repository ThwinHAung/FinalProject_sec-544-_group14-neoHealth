@extends('layouts.admin')

@section('title', 'Patient List')

@section('content')

<div class="mb-5 flex items-center space-x-4 justify-between">
    <!-- Form input -->
    <div class="flex-grow max-w-xs">
        <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Patient Id</label>
        <input type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "placeholder="Enter patient id" required>
    </div>

    <!-- Buttons -->
    <div class="flex space-x-4">
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
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Age</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Phone Number</th>
                <th scope="col" class="px-6 py-3">Address</th>
                <th scope="col" class="px-6 py-3">Emergency Address</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
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
                    <a href="#" data-modal-target="edit-doctor-modal" data-modal-toggle="edit-doctor-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('admin.patient.remove', $patient->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach       
        </tbody>
    </table>
</div>

<div class="flex flex-col items-end p-8">
    <!-- Help text -->
    <span class="text-sm text-gray-700 dark:text-gray-400">
        Showing <span class="font-semibold text-gray-900 dark:text-white">{{ ($page - 1) * $perPage + 1 }}</span> to <span class="font-semibold text-gray-900 dark:text-white">{{ $page * $perPage > $totalPatients ? $totalPatients : $page * $perPage }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $totalPatients }}</span> Entries
    </span>
    
    <!-- Pagination Buttons -->
    <div class="inline-flex mt-2 xs:mt-0">
        @if ($page > 1)
            <a href="{{ route('admin.user', ['page' => $page - 1]) }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Prev
            </a>
        @endif

        @if ($page < $totalPages)
            <a href="{{ route('admin.user', ['page' => $page + 1]) }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Next
            </a>
        @endif
    </div>
</div>

@endsection