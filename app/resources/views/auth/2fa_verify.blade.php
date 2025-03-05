<x-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md p-6 bg-white rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800">Two-Factor Authentication</h2>
        <p class="text-sm text-gray-600 text-center mb-4">Enter the authentication code from your Google Authenticator app</p>

        <form method="POST" action="{{ route('2fa.verify') }}" class="space-y-4">
            @csrf

            <div>
                <label for="otp" class="block text-sm font-medium text-gray-700">Authentication Code</label>
                <input type="text" name="otp" id="otp" required autofocus 
                       class="mt-1 block w-full px-4 py-2 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="xxxxxx">
            </div>

            @if($errors->has('otp'))
                <p class="text-sm text-red-500">{{ $errors->first('otp') }}</p>
            @endif

            <button type="submit" 
                    class="w-full px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                Verify
            </button>
        </form>
    </div>

</body>
</html>

</x-layout>
