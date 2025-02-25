<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'MyApp' }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> <!-- Alpine.js -->
</head>

<body class="bg-gray-100 text-white p-6 flex flex-col min-h-screen">
    <nav class="bg-gray-800 p-4 mb-6 shadow-lg border-b border-gray-800">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl text-gray-100 hover:text-blue-200 transition duration-300">
                User & Content Management System
            </a>
            <ul class="flex space-x-4">
                @guest
                <li>
                    <a href="{{ route('register.index') }}" class="text-gray-300 hover:text-white transition duration-300">
                        Register
                    </a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition duration-300">
                        Login
                    </a>
                </li>
                @endguest

                @auth
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white transition duration-300">
                            Logout
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <div class="container mx-auto flex flex-grow space-x-4">
    @auth
        <!-- Sidebar -->
        <aside class="w-1/4 bg-gray-800 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-center">Dashboard</h2>
            <div class="mt-2 space-y-2">
                <div class="bg-gray-200 py-4 shadow-md w-full flex justify-center text-black">
                    <a href="{{ route('users.index') }}"> Users </a>
                </div>




        </aside>
        @endauth

        <!-- Main Content -->
        <div class="flex-grow p-6 rounded-lg shadow-md">
            {{ $slot }}
        </div>
    </div>

    @vite('resources/js/app.js')
</body>



</html>