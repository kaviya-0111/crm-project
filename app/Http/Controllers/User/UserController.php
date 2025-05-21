<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Proof;

class UserController extends Controller
{
    public function uploadProof(Request $request)
    {
        $request->validate([
            'proof' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // Store file in 'storage/app/public/proofs'
        $path = $request->file('proof')->store('proofs', 'public');

        // Save file details in DB
        $proof = new Proof();
        $proof->user_id = $user->id;
        $proof->document_path = $path; // Assuming column is 'document_path'
        $proof->document_type = $request->file('proof')->getClientOriginalExtension();
        $proof->status = 'pending'; // default status (optional)
        $proof->save();

        return redirect()->back()->with('success', 'Proof uploaded successfully!');
    }
}
