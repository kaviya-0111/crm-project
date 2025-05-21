@extends('user.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Header -->
    <header class="bg-white rounded-xl shadow p-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600 text-sm">Manage your profile and documents below.</p>
    </header>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Profile Update Card -->
        <a href="{{ route('profile.edit') }}"
           class="block bg-blue-500 text-white p-6 rounded-xl shadow-md hover:bg-blue-600 transform hover:-translate-y-1 transition duration-300">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-white bg-opacity-20 rounded-full">
                    <i data-feather="user" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Update Profile</h3>
                    <p class="text-sm text-blue-100">Change name, address</p>
                </div>
            </div>
        </a>

        <!-- Document Upload Card -->
        <a href="{{ route('documents.upload') }}"
           class="block bg-green-500 text-white p-6 rounded-xl shadow-md hover:bg-green-600 transform hover:-translate-y-1 transition duration-300">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-white bg-opacity-20 rounded-full">
                    <i data-feather="file-text" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Upload Documents</h3>
                    <p class="text-sm text-green-100">Upload ID proof (PDF, JPG, PNG) for verification</p>
                    <p class="text-xs text-green-100 mt-1">Status: 
                        <span class="{{ Auth::user()->verification_status === 'verified' ? 'text-white' : 'text-yellow-200' }}">
                            {{ ucfirst(Auth::user()->verification_status) }}
                        </span>
                    </p>
                </div>
            </div>
        </a>
    </div>
@endsection
