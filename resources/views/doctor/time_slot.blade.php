@extends('layouts.doctor')

@section('title', 'Work Schedule')

@section('content')

        <!-- Section Heading: Work Schedule Form -->
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Enter Your Work Schedule</h2>

        <!-- Time Slot Form Section -->
        <form method="POST" action="{{ route('timeslot.store') }}" class="grid grid-cols-12 gap-6">
          @csrf <!-- CSRF token for security -->
          <input type="hidden" name="doctor_id" value="{{ session('doctor')->id }}">
          
          <!-- Day Selector -->
          <div class="col-span-3">
              <label for="day" class="block text-lg text-gray-700 dark:text-gray-300">Choose Day</label>
              <div class="relative flex-grow max-w-fit">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                  </svg>
                </div>
                  <input
                      id="datepicker-actions" datepicker datepicker-buttons datepicker-autoselect-today
                      name="date"
                      type="text"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="Select date"
                      required
                  >
              </div>
          </div>
      
          <!-- Start Time Selector -->
          <div class="col-span-3">
              <label for="start_time" class="block text-lg text-gray-700 dark:text-gray-300">Start Time</label>
              <select
                  id="start_time"
                  name="start_time"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  required
              >
                  @for ($i = 0; $i < 24; $i++)
                      <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                      <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                  @endfor
              </select>
          </div>
      
          <!-- End Time Selector -->
          <div class="col-span-3">
              <label for="end_time" class="block text-lg text-gray-700 dark:text-gray-300">End Time</label>
              <select
                  id="end_time"
                  name="end_time"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  required
              >
                  @for ($i = 0; $i < 24; $i++)
                      <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                      <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:30</option>
                  @endfor
              </select>
          </div>
      
          <!-- Add Time Slot Button -->
          <div class="col-span-3 flex items-center justify-center mt-6">
              <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 w-full">
                  Add Time Slot
              </button>
          </div>
      </form>
      

        <!-- Existing Time Slots Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
            <table id="timeslot-table" class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Day</th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="date"><strong>Date</strong></th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="start_time"><strong>Duty Time From</strong></th>
                        <th scope="col" class="px-6 py-3">Duty Time To</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data Rows -->
                    @foreach ($timeSlots as $key => $slot)
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                          <td class="w-4 p-4">
                              <div class="flex items-center">
                                  <input id="checkbox-table-search-{{ $key + 1 }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                                  <label for="checkbox-table-search-{{ $key + 1 }}" class="sr-only">checkbox</label>
                              </div>
                          </td>
                          <td class="px-6 py-4">{{ $key + 1 }}</td> <!-- Serial Number -->
                          <td class="px-6 py-4">{{ \Carbon\Carbon::parse($slot->date)->format('l') }}</td> <!-- Day Name -->
                          <td class="px-6 py-4">{{ $slot->date }}</td> <!-- Date -->
                          <td class="px-6 py-4">{{ $slot->start_time }}</td> <!-- Start Time -->
                          <td class="px-6 py-4">{{ $slot->end_time }}</td> <!-- End Time -->
                          <td class="flex items-center px-6 py-4">
                            <!-- Delete Form with Status Check -->
                            @if ($slot->status == 'Available')
                                <form action="{{ route('timeslot.destroy', $slot->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this time slot?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline ms-3">Delete</button>
                                </form>
                            @else
                                <button type="button" class="font-medium text-red-600 hover:underline ms-3" onclick="alert('This time slot is already booked and cannot be deleted.');">Delete</button>
                            @endif
                        </td>
                      </tr>
                    @endforeach
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
                        // If sorting the Date column (index 3), treat values as dates
                        if (idx === 3) {
                            return asc ? new Date(v1) - new Date(v2) : new Date(v2) - new Date(v1);
                        }
                        // Default sorting for other columns (if needed later)
                        return isNaN(v1) || isNaN(v2) ? v1.localeCompare(v2) : v1 - v2;
                    };
                };
            
                // Add click event listener to sortable headers
                document.querySelectorAll('th[data-sort]').forEach(th => {
                    th.addEventListener('click', function() {
                        const table = th.closest('table');
                        const tbody = table.querySelector('tbody');
                        Array.from(tbody.querySelectorAll('tr'))
                            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                            .forEach(tr => tbody.appendChild(tr));
                    });
                });
            });
        </script>
@endsection

