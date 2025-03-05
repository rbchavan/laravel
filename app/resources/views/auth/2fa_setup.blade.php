<!DOCTYPE html>
<html>
<head>
    <title>Setup 2FA</title>
</head>
<body>
    <h2>Setup Two-Factor Authentication</h2>

    <p>Scan the QR code with Google Authenticator:</p>
    <img src="data:image/png;base64,{{ $qrCode }}" />

    <form method="POST" action="{{ route('2fa.enable') }}">
        @csrf
        <input type="hidden" name="secret" value="{{ $secret }}">
        <button type="submit">Enable 2FA</button>
    </form>
</body>
</html>
