<?php

namespace App\Http\Controllers;

use App\Models\User;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class TwoFactorController extends Controller
{

    #[Get(uri: '/2fa/setup', name: '2fa.show',middleware:['auth'])]
    public function show2fa()
    {

        $google2fa = new Google2FA();
        $user = Auth::user();



        if (!$user->two_factor_secret) {
            $secret = $google2fa->generateSecretKey();
        } else {
            $secret = decrypt($user->two_factor_secret);
        }

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new ImagickImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrCode = base64_encode($writer->writeString($qrCodeUrl));

        return view('auth.2fa_setup', compact('qrCode', 'secret'));
    }

    #[Post(uri: '/enable/2fa', name: '2fa.enable',middleware:['auth'])]
    public function enable2Fa(Request $request)
    {
        $request->validate(['secret' => 'required']);

        $user = Auth::user();
        $user->two_factor_secret = encrypt($request->secret);
        $user->two_factor_enabled = true;
        $user->save();

        return redirect('/users')->with('success', 'Two-Factor Authentication enabled.');
    }

    #[Get(uri: '/verify/2fa', name: '2fa.verifyForm')]
    public function verifyForm()
    {
        return view('auth.2fa_verify');
    }




    #[Post(uri: '/verify/2fa', name: '2fa.verify')]
    public function verify2FaForm(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $user = User::find(session('2fa:user:id'));

        if (!$user) {
            return redirect('/login');
        }

        $google2fa = new Google2FA();
        $secret = decrypt($user->two_factor_secret);

        if ($google2fa->verifyKey($secret, $request->otp)) {
            session()->forget('2fa:user:id');
            Auth::login($user);
            return redirect('/users');
        }

        return back()->withErrors(['otp' => 'Invalid authentication code.']);
    }
}
