@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" id="email" name="email" required class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
            <input type="password" id="password" name="password" required class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        
        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg mt-4 hover:bg-blue-600">Login</button>
    </form>
    <div class="mt-4 text-center">
        <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Forgot Password?</a>
    </div>
@endsection
