<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 text-red-700 bg-red-100 border border-red-300 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('custom.register.submit') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Contact Number</label>
                <input type="text" name="contact_number" value="{{ old('contact_number') }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('contact_number') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4 relative">
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full px-4 py-2 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <button type="button" onclick="toggleVisibility('password', 'eye-icon1')"
                        class="absolute right-3 top-9 text-gray-600">
                    <svg id="eye-icon1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Forgot Password -->
           

            <div class="mb-4 relative">
                <label class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full px-4 py-2 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <button type="button" onclick="toggleVisibility('password_confirmation', 'eye-icon2')"
                        class="absolute right-3 top-9 text-gray-600">
                    <svg id="eye-icon2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>

            <div class="mt-6">
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                    Register
                </button>
            </div>
        </form>

        {{-- Login Link after successful registration --}}
        @if(session('success'))
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Already have an account?</p>
                <a href="{{ route('login') }}"
                   class="inline-block mt-2 bg-gray-100 text-blue-600 px-4 py-2 rounded-lg hover:underline hover:bg-gray-200 transition">
                    Login
                </a>
            </div>
        @endif
    </div>

    <script>
        function toggleVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
                          a10.05 10.05 0 012.416-3.856M6.343 6.343A9.955 9.955 0 0112 5
                          c4.477 0 8.268 2.943 9.542 7a9.982 9.982 0 01-4.338 5.104M15 12
                          a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3l18 18"/>
                `;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                          c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7
                          -4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }
    </script>

</body>
</html>
