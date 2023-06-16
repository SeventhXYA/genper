<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordEmail;
use App\Mail\ResetPasswordMail;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/');
        }

        $divisiGuard = Auth::guard('divisi');
        if ($divisiGuard->attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->with(
            'loginError',
            'Maaf username atau password anda salah!'
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function forget()
    {
        return view('login.forget');
    }

    public function sendResetEmail(Request $request)
    {
        $validated_data = $request->validate([
            'username' => ['required', 'exists:tb_user,username']
        ]);

        $user = User::where('username', $validated_data['username'])->first();

        if ($user->password_reset()->exists()) {
            $user->password_reset()->delete();
        }

        $token = Str::random(32);
        while (PasswordReset::where('token', $token)->exists()) {
            $token = Str::random(32);
        }
        $expiry = Carbon::now()->addDay();

        $reset = new PasswordReset;
        $reset->token = $token;
        $reset->user()->associate($user);
        $reset->expired_at = $expiry;
        $reset->save();

        $url = env('APP_URL') . '/reset?token=' . $token;
        Mail::to($user->email)->send(new ForgetPasswordEmail($user->name, $url));

        $redacted_email = substr($user->email, 0, 1) . '*****' . substr($user->email, strpos($user->email, '@') - 1);

        return view('login.success', [
            'message' => 'Silahkan cek ' . $redacted_email . ' untuk melakukan reset password.',
        ]);
    }

    public function reset(Request $request)
    {
        if (!$request->has('token')) {
            return redirect()->route('login');
        }

        $token = $request->query('token');
        $reset = PasswordReset::where('token', $token)->first();

        if (is_null($reset)) {
            return view('login.expired');
        }

        if (Carbon::parse($reset->expired_at)->lessThan(Carbon::now())) {
            return view('login.expired');
        }

        return view('login.reset', [
            'reset' => $reset
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validated_data = $request->validate([
            'token' => ['required', 'exists:password_resets,token'],
            'password' => ['required', 'confirmed']
        ]);

        $reset = PasswordReset::where('token', $validated_data['token'])->first();
        if (Carbon::parse($reset->expired_at)->lessThan(Carbon::now())) {
            return view('login.expired');
        }

        $user = $reset->user;
        $user->password = Hash::make($validated_data['password']);
        $user->save();
        $user->password_reset()->delete();

        return view('login.success', [
            'message' => 'Password Anda berhasil direset. Silakan login untuk melanjutkan',
        ]);
    }
}
