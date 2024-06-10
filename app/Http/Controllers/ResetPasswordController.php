<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Log;

class ResetPasswordController extends Controller
{
    /**
     * Menampilkan formulir untuk mereset kata sandi.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Menangani permintaan pengguna untuk mereset kata sandi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reset(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            $credentials = $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            );

            $status = Password::reset($credentials, function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => \Illuminate\Support\Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            });

            // Handle different status from Password::reset
            if ($status === Password::PASSWORD_RESET) {
                return redirect()->route('loginShow')->with('status', 'Password has been reset successfully!');
            } elseif ($status === Password::INVALID_USER) {
                return redirect()->back()->withInput()->withErrors(['error' => 'We can\'t find a user with that email address.']);
            }

            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        } catch (\Exception $e) {
            // Capture the error and display a message in the console log
            Log::error('Reset Password Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
