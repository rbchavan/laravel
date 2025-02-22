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
            <a href="#" class="text-2xl font-bold text-amber-400">{{ Route::is('playground.*') ? 'Posts' : 'Users' }}</a>

        </div>
    </nav>

    <div class="container mx-auto">
        {{ $slot }}
    </div>
    @vite('resources/js/app.js')
</body>

</html>