<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'document_type' => 'required|string',
        'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($request->hasFile('document')) {
        $path = $request->file('document')->store('documents', 'public');

        // Save to documents table
        $document = Document::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'document_type' => $request->document_type,
                'document_path' => $path,
            ]
        );

        // ALSO update the user's document_path field
        $user = Auth::user();
        $user->document_path = $path;
        $user->save();

        return back()->with('success', 'Document uploaded successfully!');
    }

    return back()->with('error', 'No file uploaded.');
}


    public function create()
    {
        return view('user.documents.upload');  // make sure this Blade file exists
    }
}
