<!DOCTYPE html>
<html>
<head>
    <title>Welcome to {{ config('app.name') }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; padding: 20px; margin: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <table width="500" cellpadding="0" cellspacing="0" border="0" style="background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px 0px #ccc;">
                    <tr>
                        <td align="center">
                            <h1 style="color: #333; margin: 0;">Welcome, {{ $name }}!</h1>
                            <p style="font-size: 16px; color: #555;">Thank you for registering with us. We are excited to have you on board.</p>
                            <p style="font-size: 16px; color: #555;">Click the button below to explore:</p>
                            <a href="{{ url('/login') }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #fff; background: #007bff; text-decoration: none; border-radius: 5px;">Visit Our Website</a>
                            <p style="font-size: 16px; color: #555;">Best Regards,</p>
                            <p style="font-weight: bold; font-size: 16px;">{{ config('app.name') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
