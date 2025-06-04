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

    @if(session('message'))
    <div class="flex justify-center">
        <div
            class="alert alert-success flex justify-between flex-row items-center top-20 absolute w-[600px] bg-green-600 shadow-lg rounded-md p-2 pl-5">
            {{ session('message') }}
        </div>
    </div>
    @endif

    @auth
    <div class="hidden lg:block fixed top-0 left-0 h-full w-1/5 bg-gray-100">
        @include('layouts.desktop_menu')
    </div>
    @endauth

    <div class="min-h-screen w-4/5 bg-gray-200">
        
        {{--
        <div class="p-2  bg-sky-400 text-black flex justify-end">

            <div class=" p-2 px-4 rounded-[50px]">#{{ Auth::id() }}</div>
            <div class=" p-2 px-4 rounded-[50px]">{{ Auth::user()->name }}</div>
            <div class="bg-sky-300 p-2 px-4 rounded-[50px]">${{ Auth::user()->balance }}</div>

            <div class="ml-4 flex items-center lg:ml-6">
                <div class="relative">

                    <button class="max-w-xs rounded-full flex items-center text-sm focus:outline-none">
                        <span class="sr-only">Open user menu</span>
                        <a href="{{ route('profile.edit') }}">

                            @if(Auth::user()->profile_photo && file_exists(storage_path('app/public/' .
                            Auth::user()->profile_photo)))
                            <img class="min-w-10 min-h-10 max-w-10 max-h-10 rounded-[50px]"
                                src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
                            @else
                            <img class="min-w-10 min-h-10 max-w-10 max-h-10 rounded-[50px]"
                                src="{{ asset('assets/avatar.png') }}" alt="Avatar">
                            @endif

                        </a>
                    </button>

                </div>
            </div>

        </div> --}}

        <div class="flex flex-col lg:flex-row">

            <div class="w-full">
                {{ $slot }}
            </div>

            <div class="bg-white h-screen">
                @include('layouts.sidebar')
            </div>
        </div>

    </div>




    {{-- @auth
    @include('layouts.mobile_menu')
    @endauth --}}

</body>

</html>