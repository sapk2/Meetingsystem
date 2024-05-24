
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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <a href="{{route('user.dashboard')}}" class="px-4 py-2 text-white hover:bg-blue-900 block border-l-white border-l-4 ml-2 mt-2"><i class="fa-solid fa-gauge"> Dashboard</i></a>
         
    <form action="{{route('logout')}}" method="POST" class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-gray-200 focus:outline-none">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-left text-gray-800 hover:bg-gray-200 focus:outline-none">
                        Logout
                    </button>
                </form>
        <div class="min-h-screen bg-gray-100">
           @yield('content')
        </div>
    </body>
</html>
