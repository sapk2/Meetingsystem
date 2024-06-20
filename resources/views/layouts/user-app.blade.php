<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/beb264445c.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        marquee{
            z-index: 1;
            position: relative;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-200">
        <!-- Navbar -->
        <nav class="bg-white shadow">
            <div class="container mx-auto px-4">
                <div class="flex justify-between">
                    <div class="flex space-x-4">
                        <!-- Logo -->
                        <div>
                            <a href="{{ route('user.dashboard') }}" class="flex items-center py-5 px-2 text-gray-700 hover:text-gray-900">
                            <img src="/img/images.png" class="h-8 me-3" alt="FlowBite Logo" />
         
                               
                            </a>
                        </div>
                        <!-- Primary Nav -->
                        <div class="hidden md:flex items-center space-x-1">
                            <a href="{{route('user.dashboard')}}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Dashboard</a>
                            <a href="{{route('user.meeting.index')}}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Meetings</a>
                            <a href="{{route('user.agenda')}}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Agendas</a>
                            <a href="#" class="py-5 px-3 text-gray-700 hover:text-gray-900">profile</a>
                        </div>
                    </div>
                    <!-- Secondary Nav -->
                    <div class="hidden md:flex items-center space-x-1">
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="py-5 px-3 text-gray-700 hover:text-gray-900">Logout</button>
                        </form>
                    </div>
                    
                    <!-- Mobile button goes here -->
                    <div class="md:hidden flex items-center">
                        <button class="mobile-menu-button">
                            <svg class="w-6 h-7 text-gray-700 hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        @if(request()->routeIs('user.dashboard'))
       <!-- <marquee class="bg-yellow-300 py-2">
            @foreach($notices as $item)
            {{$item->message}}--|--
            @endforeach
        </marquee>-->
        @endif

    
        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden bg-blue-200">
            <a href="{{route('user.dashboard')}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-200">Dashboard</a>
            <a href="{{route('user.meeting.index')}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-200">Meetings</a>
            <a href="{{route('user.agenda')}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-200">Agendas</a>
            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-200">profile</a>
            <form action="{{route('logout')}}" method="POST" class="block">
                @csrf
                <button type="submit" class="block w-full text-left py-2 px-4 text-sm text-gray-700 hover:bg-gray-200">Logout</button>
            </form>
        </div>
      

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Scripts for mobile menu -->
    <script>
        const btn = document.querySelector('button.mobile-menu-button');
        const menu = document.querySelector('.mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
