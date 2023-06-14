<?php

namespace App\Http\Controllers;

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

    // public function forget()
    // {
    //     return view('login.forget');
    // }

    // public function sendResetEmail(Request $request)
    // {
    //     $username = $request->validate([
    //         'username' => ['required']
    //     ])['username'];

    //     $user = User::where('username', '=', $username)
    //         ->orWhere('email', '=', $username)
    //         ->first();

    //     if (is_null($user)) {
    //         return redirect()->back()->withErrors([
    //             'username' => 'Username atau Email tidak terdaftar.'
    //         ]);
    //     }

    //     $token = Str::random(64);

    //     $reset = new PasswordReset;
    //     $reset->token = $token;
    //     $reset->user()->associate($user);
    //     $reset->save();

    //     $reset->token = $token;

    //     Mail::to($reset->user->email)->send(new ResetPasswordMail($reset));

    //     if (Mail::flushMacros()) {
    //         return redirect()->back()->with([
    //             'error' => 'Gagal mengirimkan Email untuk Reset Password.'
    //         ]);
    //     }

    //     return redirect()->back()->with([
    //         'success' => 'Silakan cek Email Anda untuk menyelesaikan Reset Password.'
    //     ]);
    // }

    // public function reset(Request $request)
    // {
    //     if (!$request->has('token')) {
    //         return redirect()->route('login');
    //     }

    //     $token = $request->query('token');
    //     $reset = PasswordReset::find($token);

    //     if (is_null($reset)) {
    //         return redirect()->route('login');
    //     }

    //     if (Carbon::parse($reset->created_at)->diffInDays(Carbon::now()) > 0) {
    //         return view('login.message', [
    //             'title' => 'Error',
    //             'message' => 'Permintaan Reset Password Anda telah kedaluarsa. Silakan ajukan Reset Password kembali.',
    //             'button_title' => 'Reset Password',
    //             'button_href' => route('login.forget')
    //         ]);
    //     }

    //     return view('login.reset', [
    //         'reset' => $reset
    //     ]);
    // }

    // public function resetPassword(Request $request)
    // {
    //     $validated_data = $request->validate([
    //         'token' => ['required', 'exists:password_resets'],
    //         'password' => ['required', 'confirmed']
    //     ]);

    //     $reset = PasswordReset::find($validated_data['token']);

    //     if (Carbon::parse($reset->created_at)->diffInDays(Carbon::now()) > 0) {
    //         return view('login.message', [
    //             'title' => 'Error',
    //             'message' => 'Permintaan Reset Password Anda telah kedaluarsa. Silakan ajukan Reset Password kembali.',
    //             'button_title' => 'Reset Password',
    //             'button_href' => route('login.forget')
    //         ]);
    //     }

    //     $user = User::find($reset->user->id);
    //     $user->password = Hash::make($validated_data['password']);
    //     $user->save();

    //     $user->password_reset()->delete();

    //     return view('login.message', [
    //         'title' => 'Sukses',
    //         'message' => 'Password Anda berhasil direset. Silakan login untuk melanjutkan',
    //         'button_title' => 'Login',
    //         'button_href' => route('login')
    //     ]);
    // }
}
