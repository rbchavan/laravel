<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MyApp' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-900 text-white p-6">

<nav class="bg-gray-800 p-4 mb-6 shadow-lg border-b border-gray-700">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <a href="#" class="text-2xl font-bold text-amber-400">MyApp</a>
        <ul class="flex space-x-8">
            <li><a href="#" class="text-green-300 hover:text-amber-400 transition duration-300">Home</a></li>
            <li><a href="#" class="text-green-300 hover:text-amber-400 transition duration-300">Users</a></li>
            <li><a href="#" class="text-green-300 hover:text-amber-400 transition duration-300">Settings</a></li>
            
        </ul>
    </div>
</nav>




    <!-- Main Content -->
    <div class="container mx-auto">
        {{ $slot }}
    </div>

</body>

</html>