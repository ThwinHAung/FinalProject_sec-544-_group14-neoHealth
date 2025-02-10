@extends('layouts.doctor')

@section('title', 'Medicine Prescription')

@section('content')

<!-- Button to trigger the modal -->
<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="px-4 py-2 text-white bg-blue-700 hover:bg-blue-800 rounded-lg mb-5">Create Prescription</button>

<!-- Modal content -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create Medicine Prescription
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form id="prescription-form" class="space-y-4" action="#">
                    <div>
                        <label for="appointment-id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment ID</label>
                        <select name="appointment-id" id="appointment-id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                            <option value="">Select Appointment ID</option>
                            <option value="11102">Appointment 11102</option>
                            <option value="1102">Appointment 1102</option>
                            <option value="11202">Appointment 11202</option>
                            <option value="11302">Appointment 11302</option>
                            <option value="11402">Appointment 11402</option>
                            <option value="11502">Appointment 11502</option>
                            <option value="11602">Appointment 11602</option>
                            <option value="11702">Appointment 11702</option>
                            <option value="11802">Appointment 11802</option>
                            <option value="11902">Appointment 11902</option>
                        </select>
                        
                    </div>
                    <div>
                        <label for="medicine-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medicine Name</label>
                        <input type="text" name="medicine-name" id="medicine-name" placeholder="Enter medicine name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" name="description" id="description" placeholder="Enter description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                    </div>
                    <div>
                        <label for="dosage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dosage</label>
                        <input type="text" name="dosage" id="dosage" placeholder="Enter dosage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                    </div>
                    <div>
                        <label for="start-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                        <input type="date" name="start-date" id="start-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                    </div>
                    <div>
                        <label for="end-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                        <input type="date" name="end-date" id="end-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                    </div>
                    <div>
                        <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Note</label>
                        <textarea name="note" id="note" placeholder="Enter any notes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"></textarea>
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
                <th scope="col" class="px-6 py-3">Medicine Name</th>
                <th scope="col" class="px-6 py-3">Dosage</th>
                <th scope="col" class="px-6 py-3">Date Range</th>
                <th scope="col" class="px-6 py-3">Appointment Date</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample Prescription Data -->
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">1</td>
                <td class="px-6 py-4">Alice Johnson</td>
                <td class="px-6 py-4">Paracetamol</td>
                <td class="px-6 py-4">500mg</td>
                <td class="px-6 py-4">2025-02-01 to 2025-02-10</td>
                <td class="px-6 py-4">2025-02-05</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="openModal()">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-2" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-2" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">2</td>
                <td class="px-6 py-4">Bob Martin</td>
                <td class="px-6 py-4">Amoxicillin</td>
                <td class="px-6 py-4">250mg</td>
                <td class="px-6 py-4">2025-02-03 to 2025-02-07</td>
                <td class="px-6 py-4">2025-02-06</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
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
                <td class="px-6 py-4">Charlie Williams</td>
                <td class="px-6 py-4">Ibuprofen</td>
                <td class="px-6 py-4">200mg</td>
                <td class="px-6 py-4">2025-02-01 to 2025-02-07</td>
                <td class="px-6 py-4">2025-02-07</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-4" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-4" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">4</td>
                <td class="px-6 py-4">Diana Green</td>
                <td class="px-6 py-4">Amoxicillin</td>
                <td class="px-6 py-4">500mg</td>
                <td class="px-6 py-4">2025-02-05 to 2025-02-12</td>
                <td class="px-6 py-4">2025-02-08</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-5" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-5" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">5</td>
                <td class="px-6 py-4">Edward Black</td>
                <td class="px-6 py-4">Atorvastatin</td>
                <td class="px-6 py-4">40mg</td>
                <td class="px-6 py-4">2025-02-01 to 2025-02-10</td>
                <td class="px-6 py-4">2025-02-09</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-6" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-6" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">6</td>
                <td class="px-6 py-4">Fiona White</td>
                <td class="px-6 py-4">Clopidogrel</td>
                <td class="px-6 py-4">75mg</td>
                <td class="px-6 py-4">2025-02-01 to 2025-02-14</td>
                <td class="px-6 py-4">2025-02-10</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-7" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-7" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">7</td>
                <td class="px-6 py-4">George Martin</td>
                <td class="px-6 py-4">Metformin</td>
                <td class="px-6 py-4">500mg</td>
                <td class="px-6 py-4">2025-02-02 to 2025-02-10</td>
                <td class="px-6 py-4">2025-02-11</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-8" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-8" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">8</td>
                <td class="px-6 py-4">Hannah Lee</td>
                <td class="px-6 py-4">Lisinopril</td>
                <td class="px-6 py-4">10mg</td>
                <td class="px-6 py-4">2025-02-01 to 2025-02-12</td>
                <td class="px-6 py-4">2025-02-12</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-9" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-9" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">9</td>
                <td class="px-6 py-4">Irene Scott</td>
                <td class="px-6 py-4">Pantoprazole</td>
                <td class="px-6 py-4">20mg</td>
                <td class="px-6 py-4">2025-02-03 to 2025-02-10</td>
                <td class="px-6 py-4">2025-02-13</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-10" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-10" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4">10</td>
                <td class="px-6 py-4">Jack Turner</td>
                <td class="px-6 py-4">Levothyroxine</td>
                <td class="px-6 py-4">50mcg</td>
                <td class="px-6 py-4">2025-02-01 to 2025-02-14</td>
                <td class="px-6 py-4">2025-02-14</td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Details</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

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
        </div>
    </div>
</div>
<script>
    function openModal() {
        document.getElementById('detailsModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }
</script>
@endsection