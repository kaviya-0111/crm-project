<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
<div class="w-full max-w-md p-8 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div id="success-message" class="mb-4 text-green-700 bg-green-100 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div id="error-message" class="mb-4 text-red-700 bg-red-100 p-3 rounded transition-opacity duration-1000">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.login.submit') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4 relative">
            <label class="block mb-1 font-semibold text-gray-700">Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full border px-4 py-2 pr-10 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">

            <!-- Eye Icon Button -->
            <button type="button" onclick="togglePassword()" class="absolute right-2 top-9 text-gray-600">
                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </div>

        <!-- <div class="mb-4 text-right">
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
        </div> -->

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Login
        </button>
    </form>

    <p class="mt-6 text-sm text-center text-gray-600">
        Don't have an account?
        <a href="{{ route('custom.register') }}" class="text-blue-600 hover:underline">Register</a>
    </p>
</div>

<script>
    // Auto-hide messages
    setTimeout(() => {
        const errorBox = document.getElementById('error-message');
        if (errorBox) {
            errorBox.style.opacity = '0';
            setTimeout(() => errorBox.remove(), 1000);
        }

        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.opacity = '0';
            setTimeout(() => successMessage.remove(), 1000);
        }
    }, 2000);

    // Toggle password visibility
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.416-3.856M6.343 6.343A9.955 9.955 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.982 9.982 0 01-4.338 5.104M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 3l18 18"/>
            `;
        } else {
            passwordField.type = "password";
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            `;
        }
    }
</script>

</body>
</html>
