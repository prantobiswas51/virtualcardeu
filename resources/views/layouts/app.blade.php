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

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
       
    </head>

    <body class="font-sans bg-gray-900">

        <div class="text-white max-w-[800px] mx-auto  mb-[100px]">

            @if(session('message'))
                <div class="flex justify-center">
                    <div class="alert alert-success flex justify-between flex-row items-center top-20 absolute w-[600px] bg-green-600 shadow-lg rounded-md p-2 pl-5">
                        {{ session('message') }}<span class="p-4 bg-red-900 rounded-r-md text-white">X</span>
                    </div>
                </div>
            @endif

            @include('layouts.navigation')
            <main>
                {{ $slot }}
            </main>
        </div>

        @auth
            @include('layouts.footer')
        @endauth

    </body>
</html>
