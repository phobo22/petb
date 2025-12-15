<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserProfile;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function handleRegister(Request $request) {
        $validated = $request->validate([
            'firstname' => 'required|string|min:3|max:10',
            'lastname' => 'required|string|min:3|max:10',
            'email' => 'required|email',
            'password' => 'required|min:8', 
        ]);

        $user = User::create([
            // 'firstname' => $validated['firstname'],
            // 'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('home');
    }
    
    public function handleLogin(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()
            ->withErrors(['credentials' => "Incorrect email or password"])
            ->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
