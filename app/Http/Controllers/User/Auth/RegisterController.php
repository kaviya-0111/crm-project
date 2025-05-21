<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showform()
    {
        // Return the registration view
        return view('user.auth.register'); // Make sure resources/views/user/register.blade.php exists
    }

    /**
     * Handle the registration request.
     */
    public function register(Request $request)
    {
        // Validate the request data
        $this->validator($request->all())->validate();

        // Create the user
        $this->create($request->all());

        // Redirect to login with success message
        return redirect()->route('user.login')->with('success', 'Registration successful! Please log in.');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after valid registration.
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
