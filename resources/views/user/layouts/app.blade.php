<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 to-blue-200 min-h-screen font-sans">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-6 hidden md:block fixed h-full">
            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center space-x-2 p-3 rounded-lg transition
                   {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700 font-semibold shadow-inner' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50' }}">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center space-x-2 p-3 rounded-lg transition
                   {{ request()->routeIs('profile.edit') ? 'bg-indigo-100 text-indigo-700 font-semibold shadow-inner' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50' }}">
                    <i data-feather="user" class="w-5 h-5"></i>
                    <span>Edit Profile</span>
                </a>

                <a href="{{ route('documents.upload') }}"
                   class="flex items-center space-x-2 p-3 rounded-lg transition
                   {{ request()->routeIs('documents.upload') ? 'bg-indigo-100 text-indigo-700 font-semibold shadow-inner' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50' }}">
                    <i data-feather="file-text" class="w-5 h-5"></i>
                    <span>Upload Documents</span>
                </a>
            </nav>
        </aside>

        <!-- Main content area -->
        <div class="flex-1 md:ml-64 min-h-screen flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md h-16 flex items-center justify-end px-6 sticky top-0 z-30">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-800 font-semibold">{{ Auth::user()->name }}</span>

                    <!-- Profile Picture Upload Form -->
                    <form id="profile-picture-form" action="{{ route('profile.picture.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="profile_picture_input" class="cursor-pointer" title="Click to change profile picture">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                     alt="Profile Picture"
                                     class="w-10 h-10 rounded-full object-cover border-2 border-indigo-300" />
                            @else
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-lg font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </label>
                        <input type="file" name="profile_picture" id="profile_picture_input" accept="image/*" class="hidden"
                               onchange="document.getElementById('profile-picture-form').submit();">
                    </form>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex items-center space-x-2 p-2 rounded-lg text-red-600 hover:text-red-800 hover:bg-red-50 transition">
                            <i data-feather="log-out" class="w-5 h-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>
