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
    @livewireStyles

</head>

<body class="font-sans">

    @auth
        <div class="hidden lg:block fixed h-full w-1/6 bg-white">
            @include('layouts.desktop_menu')
        </div>
    @endauth

    <div class="bg-gray-200 lg:ml-[16.66%] lg:w-5/6 flex flex-col lg:flex-row min-h-screen relative">

        @if (session('message'))
            <div class="fixed top-[100px] left-1/2 transform -translate-x-1/2 z-50">
                <div
                    class="bg-green-600 text-white shadow-lg rounded-md px-6 py-3 w-auto max-w-full text-center animate-fade-in">
                    {{ session('message') }}
                </div>
            </div>

            <style>
                @keyframes fade-in {
                    from {
                        opacity: 0;
                        transform: translateY(-10px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .animate-fade-in {
                    animation: fade-in 0.3s ease-out;
                }
            </style>
        @endif

        @if (session('alert'))
            <div class="fixed top-[100px] left-1/2 transform -translate-x-1/2 z-50">
                <div
                    class="bg-red-600 text-white shadow-lg rounded-md px-6 py-3 w-auto max-w-full text-center animate-fade-in">
                    {{ session('alert') }}
                </div>
            </div>

            <style>
                @keyframes fade-in {
                    from {
                        opacity: 0;
                        transform: translateY(-10px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .animate-fade-in {
                    animation: fade-in 0.3s ease-out;
                }
            </style>
        @endif


        <!-- Main Content -->
        <div class="w-full  lg:w-3/4 lg:pr-[5%]">
            {{ $slot }}
        </div>

        <!-- Sidebar -->
        <div class="hidden lg:block  w-1/4 p-4 ">
            @include('layouts.sidebar')
        </div>

    </div>

    @auth
        @include('layouts.mobile_menu')
    @endauth
    @livewireScripts

</body>

</html>
