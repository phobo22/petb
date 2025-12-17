<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index() {
        return view('profiles.index');
    }

    public function show(Request $request) {
        return view('profiles.show', ['profile' => $request->user()->profile]);
    }

    public function edit(Request $request) {
        return view('profiles.edit', ['profile' => $request->user()->profile]);
    }

    public function update(Request $request) {
        $validated = $request->validate([
            'firstname' => 'required|string|min:3|max:15',
            'lastname' => 'required|string|min:3|max:15',
            'dob' => 'date',
            'gender' => 'in:0,1',
            'phone' => 'string',
            'address' => 'string',
        ]);

        $request->user()->profile->update($validated);
        return redirect()->route('profile.show')->with('success', 'Update profile successfully !!');
    }
}
