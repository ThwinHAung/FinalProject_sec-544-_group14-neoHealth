@extends('layouts.auth')

@section('title', 'Login')

@section('content')
{{-- <div class="h-fit bg-gray-50 flex items-center justify-center"> --}}
    <div class="bg-white shadow-md rounded-lg p-8 flex max-w-4xl w-full">
        <!-- Left Section (Illustration & Text) -->
        <div class="w-1/2 flex flex-col justify-center  border-r border-gray-200 p-4">
            <h1 class="text-4xl font-bold text-gray-700">
                Neo  <span class="text-green-500">Health</span>
            </h1>
            <p class="mt-4 text-gray-500 text-center">
                "Your journey to better health starts here.Empowering Wellness, Redefining Care. Login to access personalized care and wellness solutions."
            </p>
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Healthcare Illustration" class="mt-4 w-120 h-72">
        </div>

        <!-- Right Section (Login Form) -->
        <div class="w-1/2 p-8">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">
                Healthcare
            </h2>
            <p class="mt-2 text-gray-500 text-center">
                Welcome back! Please login to your account.
            </p>

            <form action="{{ route('login') }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full p-3 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('email')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full p-3 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox text-green-500">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-green-500 hover:underline">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit"
                    class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600">
                    Login
                </button>
            </form>

            <div class="mt-4 flex justify-between items-center">
                <p class="text-gray-500 text-sm">Don't have an account?</p>
                <a href="{{ route('register') }}" class="text-green-500 font-medium hover:underline">
                    Sign up
                </a>
            </div>

            <div class="mt-6 text-center">
                <a href="#" class="text-gray-500 hover:underline">Contact us</a>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
