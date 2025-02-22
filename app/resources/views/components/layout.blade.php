<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MyApp' }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> <!-- Alpine.js -->
</head>

<body class="bg-gray-900 text-white p-6">

    <nav class="bg-teal-500 p-4 mb-6 shadow-lg border-b border-gray-800">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <!-- Left Side (Logo / Title) -->
            <a href="#" class="text-2xl text-gray-800 hover:text-blue-200 transition duration-300">
                {{ Route::is('playground.*') ? 'Posts' : 'Users' }}
            </a>

            <!-- Right Side (Dropdown using Alpine.js) -->
            <div class="relative" x-data="{ open: false }">
                <!-- Menu Button -->
                <button @click="open = !open" @click.away="open = false"
                    class="text-gray-800 hover:text-blue-200 transition duration-300 px-4 py-2">
                    Menu ▼
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" class="absolute right-0 mt-2 min-w-[150px] bg-white text-gray-900 rounded-lg shadow-lg"
                    x-transition.opacity>
                    <a href="{{ route('users.index') }}" class="block px-4 py-2 hover:bg-gray-200">Users</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Posts</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto">
        {{ $slot }}
    </div>

    @vite('resources/js/app.js')

</body>

</html>
