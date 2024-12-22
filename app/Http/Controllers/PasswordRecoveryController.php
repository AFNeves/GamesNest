<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordRecoveryController extends Controller
{
    public function sendRecoveryLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;

        // Generate a signed URL valid for 15 minutes
        $url = URL::temporarySignedRoute(
            'password.reset', 
            now()->addMinutes(15), 
            ['email' => $email]
        );

        // Send email with the signed URL
        Mail::send('emails.password-reset', ['url' => $url], function ($message) use ($email) {
            $message->to($email)
                ->subject('Password Reset Link');
        });

        return back()->with('status', 'A password reset link has been sent to your email.');
    }

    public function showResetForm(Request $request)
{
    if (!$request->hasValidSignature()) {
        abort(403, 'Invalid or expired link.');
    }

    return view('auth.reset-password', ['email' => $request->email]);
}

public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|confirmed|min:8',
    ]);

    User::where('email', $request->email)->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('status', 'Your password has been reset.');
}

}
