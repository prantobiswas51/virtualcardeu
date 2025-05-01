<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Virtual Card EU</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans">

    <div class="flex flex-col min-h-screen">

        {{-- Main Header --}}
        @include('layouts.navigation')

        @if(session('message'))
        <div class="flex justify-center">
            <div
                class="alert alert-success flex justify-between flex-row items-center top-20 absolute w-[600px] bg-green-600 shadow-lg rounded-md p-2 pl-5">
                {{ session('message') }}
            </div>
        </div>
        @endif

        <main class="flex-1 flex bg-gray-100 flex-col md:flex-row">

            <!-- Desktop Side Navigation -->
            @auth
                @include('layouts.desktop_menu')
            @endauth

            <!-- Main Content -->
            {{ $slot }}

        </main>

    </div>

    @auth
        @include('layouts.mobile_menu')
    @endauth

</body>

</html>


