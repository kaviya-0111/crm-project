<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the user's dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard.dashboard', compact('user')); // Points to resources/views/user/dashboard.blade.php
    }
}
