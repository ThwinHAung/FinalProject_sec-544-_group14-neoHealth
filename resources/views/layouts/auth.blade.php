<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800 dark:text-white">Login</h2>

        <!-- Content (Login Form) -->
        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>
