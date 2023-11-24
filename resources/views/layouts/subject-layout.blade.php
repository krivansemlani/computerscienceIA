<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Subject Management</title>

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navigation (You can include your navigation here if needed) -->
       


        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
