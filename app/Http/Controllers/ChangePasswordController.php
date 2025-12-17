<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index() {
        return view('auth.change-password');
    }

    public function update(Request $request) {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = $request->user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        //$user->setRememberToken(Str::random(60));
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Password changed successfully');
    }
}
