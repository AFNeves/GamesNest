<?php
 
namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLoginForm(): RedirectResponse|View
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auth.login');
        }
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'required|min:1|max:255',
            'password' => 'required|min:1|max:255',
        ]);

        $type = filter_var($validated['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $type => $validated['username'],
            'password' => $validated['password'],
        ];
 
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->intended();
        }
 
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    /**
     * Log out the user from application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->with('success', 'You have logged out successfully!');
    } 
}
