<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Search functionality
        $query = User::with('document');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
                  
        }

        $users = $query->paginate(10);

        return view('admin.dashboard', compact('users'));
    }
}
