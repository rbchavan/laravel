<x-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Setup Two-Factor Authentication</h2>

        <p class="text-sm text-gray-600 text-center mb-4">Scan the QR code with Google Authenticator:</p>

        <div class="flex justify-center mb-4">
            <img src="data:image/png;base64,{{ $qrCode }}" class="rounded-lg shadow-lg border border-gray-300 p-2">
        </div>

        <form method="POST" action="{{ route('2fa.enable') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="secret" value="{{ $secret }}">

            <button type="submit" 
                    class="w-full px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
                Enable 2FA
            </button>
        </form>
    </div>
</x-layout>
