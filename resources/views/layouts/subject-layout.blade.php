<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Management</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .table  {
            border:1px solid;
            width:100%;
        }
        .table th {
            border:1px solid;
        }

        .table td  {
            border:1px solid;
           text-align: center;
        }
        .table th,
        .table td {
            padding: 15px; 
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 "":bg-gray-900">
        <x-app-layout>
            <main class="py-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </x-app-layout>
    </div>

    
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
