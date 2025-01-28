@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <h3 class="text-3xl font-semibold text-gray-800 dark:text-white">Welcome to the Admin Dashboard</h3>
    <p class="mt-4 text-gray-600 dark:text-gray-300">Here is a summary of your dashboard statistics.</p>

    <!-- Example Content -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Total Users</h4>
            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">1,245</p>
        </div>
        <!-- Card 2 -->
        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">New Orders</h4>
            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">52</p>
        </div>
        <!-- Card 3 -->
        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Revenue</h4>
            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">$12,628</p>
        </div>
    </div>
@endsection
