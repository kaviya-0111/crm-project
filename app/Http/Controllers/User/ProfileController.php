<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show the edit profile form
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    // Handle the profile update
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            // 'contact_number' => 'nullable|string|max:15',
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->address = $request->input('address');
        // $user->contact_number = $request->input('contact_number');
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
