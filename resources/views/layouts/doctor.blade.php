<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Doctor Dashboard')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="h-16 flex items-center justify-center bg-gray-900">
                <h1 class="text-4xl font-bold text-white">
                    Neo  <span class="text-green-500">Health</span>
                </h1>
            </div>
            <ul class="space-y-2 mt-4 px-4">
                <li><a href="{{route('doctor.dashboard')}}" class="block py-2 text-lg text-gray-300 hover:bg-gray-700 rounded">Dashboard</a></li>
                <li><a href="{{route('doctor.appointment_history')}}" class="block py-2 text-lg text-gray-300 hover:bg-gray-700 rounded">Booking History</a></li>
                <li><a href="{{route ('doctor.create_prescription')}}" class="block py-2 text-lg text-gray-300 hover:bg-gray-700 rounded">Create Prescription</a></li>
                <li><a href="{{route('doctor.working_schedule')}}" class="block py-2 text-lg text-gray-300 hover:bg-gray-700 rounded">Available Schedule</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Navbar -->
            <div class="flex items-center justify-between mb-6">
                <div class="text-xl font-semibold text-gray-800 dark:text-white">Dashboard</div>
                <div class="space-x-4">
                    <button onclick="fetchDoctorProfile()" class="bg-blue-500 text-white px-4 py-2 rounded">Profile</button>
                    <a href="{{route('logout')}}" class="bg-red-500 text-white px-4 py-3 rounded">Logout</a>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>

<!-- Custom Script for Datepicker Initialization -->
</body>
<div id="profile-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
    <div class="p-4 w-full max-w-4xl max-h-full">
        <div class="bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Doctor Profile
                </h3>
                <button type="button" 
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                    onclick="closeProfileModal()"
                    data-modal-hide="profile-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
    
            <div class="p-4 md:p-5">
                <form id="update-doctor-form" method="POST" action="{{ route('doctor.update.profile') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="profile-id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor ID</label>
                        <input type="text" name="doctor_id" id="profile-id" readonly 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed" />
                    </div>
    
                    <div>
                        <label for="profile-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input type="text" name="name" id="profile-name" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>

                    <div>
                        <label for="profile-degree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree</label>
                        <input type="text" name="degree" id="profile-degree" readonly
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>

                    <div>
                        <label for="profile-department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <input type="text" name="department" id="profile-department" readonly
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>

                    <div>
                        <label for="profile-specialty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <input type="text" name="specialty" id="profile-specialty" readonly
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>

                    <div>
                        <label for="profile-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="profile-email" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>
    
                    <div>
                        <label for="profile-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="text" name="phone_number" id="profile-phone" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    </div>
    
                    <div>
                        <label for="profile-length" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Length of Employment</label>
                        <input type="text" id="profile-length" readonly 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed" />
                    </div>
    
                    <div class="flex justify-between">
                        <button type="submit" 
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<script>
    function fetchDoctorProfile() {
        fetch("{{ route('doctor.profile') }}")
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("Doctor profile not found.");
                    return;
                }

                // Populate form fields
                document.getElementById('profile-id').value = data.id;
                document.getElementById('profile-name').value = data.name;
                document.getElementById('profile-degree').value = data.degree;
                document.getElementById('profile-department').value = data.department;
                document.getElementById('profile-specialty').value = data.specialty;
                document.getElementById('profile-email').value = data.email;
                document.getElementById('profile-phone').value = data.phone_number;
                document.getElementById('profile-length').value = data.length_of_employment;

                // Calculate Length of Employment
                const startDate = new Date(data.start_date);
                const today = new Date();
                const years = today.getFullYear() - startDate.getFullYear();
                const months = today.getMonth() - startDate.getMonth();
                
                let lengthOfEmployment = `${years} years`;
                if (months > 0) {
                    lengthOfEmployment += ` and ${months} months`;
                }

                document.getElementById("profile-length").value = lengthOfEmployment;

                // Show modal
                document.getElementById("profile-modal").classList.remove("hidden");
            })
            .catch(error => {
                console.error("Error fetching doctor profile:", error);
                alert("Failed to load profile.");
            });
    }
    function closeProfileModal() {
        document.getElementById("profile-modal").classList.add("hidden");
    }
</script>
</html>
