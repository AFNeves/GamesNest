<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Shows the registration form.
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle the user registration.
     */
    public function register(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|min:5|max:20|unique:users,username',
            'email' => 'required|string|max:255|email|unique:users,email',
            'password' => 'required|string|max:255|confirmed',
        ], [
            'first_name.required' => 'Oops! You forgot your first name.',
            'last_name.required' => 'Hey, we need your last name too!',
            'username.required' => 'Don\'t be shy, pick a cool username.',
            'email.required' => 'We need your email to send you awesome stuff.',
            'password.required' => 'Your password cannot be empty. Please provide one!',
            'first_name.max' => 'Your first name is too long. It can\'t be more than 255 characters. Are you royalty?',
            'last_name.max' => 'Your last name is too long. It can\'t be more than 255 characters. That\'s quite a mouthful!',
            'username.min' => 'Your username is too short. It needs to be at least 5 characters long. Short and sweet doesn\'t work here!',
            'username.max' => 'Your username is too long. It can\'t be more than 20 characters. Keep it snappy!',
            'email.max' => 'Your email is too long. It can\'t be more than 255 characters. Keep it concise!',
            'password.max' => 'Your password is too long. It can\'t be more than 255 characters. No need for an essay!',
            'username.unique' => 'This cool username is already taken. Try another one!',
            'email.unique' => 'This email is already registered. Maybe try logging in?',
            'email.email' => 'Hmm, that doesn\'t look like a valid email.',
            'password.confirmed' => 'Passwords don\'t match. Double-check and try again.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only('first_name', 'last_name', 'username', 'email');
        $data['password'] = Hash::make($request->password);

        UserController::storeDirect($data);

        Auth::attempt([
            'email' => $request->email,         // Use raw email from request
            'password' => $request->password    // Use raw password from request
        ]);

        $request->session()->regenerate();

        return redirect()->route('login')
            ->with('success', 'Registration successful. Please log in.');
    }
}
