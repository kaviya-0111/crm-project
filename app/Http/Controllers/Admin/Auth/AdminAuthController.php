<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // ✅ Add this line

class AdminAuthController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle admin login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials']);
    }

    // Show the admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ✅ Show all users with their uploaded documents (with search/filter)
    public function viewUsers(Request $request)
    {
        $query = User::with('document'); // ✅ Use correct relationship name

        // ✅ Optional search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        // ✅ Optional filter: only users who uploaded document
        if ($request->has('has_proof') && $request->has_proof == '1') {
            $query->whereHas('document');
        }

        $users = $query->paginate(10);

        return view('admin.users', compact('users'));
    }

    // Handle admin logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
