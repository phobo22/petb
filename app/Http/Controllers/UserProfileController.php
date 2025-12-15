<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    public function show(UserProfile $profile) {
        return view('profiles.show', ['page' => 'show', 'profile' => $profile]);
    }

    public function edit(UserProfile $profile) {
        return view('profiles.show', ['page' => 'edit', 'profile' => $profile]);
    }

    public function update(Request $request, UserProfile $profile) {
        $validated = $request->validate([
            'firstname' => 'required|string|min:3|max:15',
            'lastname' => 'required|string|min:3|max:15',
            'dob' => 'date',
            'gender' => 'in:0,1',
            'phone' => 'string',
            'address' => 'string',
        ]);

        $profile->update($validated);
        return redirect()->route('profile.show', $profile)->with('success', 'Update profile successfully !!');
    }
}
