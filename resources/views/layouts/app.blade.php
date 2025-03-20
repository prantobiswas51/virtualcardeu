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

        <div class="p-2 bg-red-400 text-center">
            Website under construction <br> For emergency => prantobd320@gmail.com
        </div>

        <div class="text-white max-w-[800px] mx-auto  mb-[100px]">

            @if(session('message'))
                <div class="alert alert-success bg-gray-500">
                    {{ session('message') }} <span class="p-2 px-4 bg-red-900 text-white">X</span>
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
