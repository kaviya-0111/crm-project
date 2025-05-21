<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile & Document Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10 px-4">

    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Edit Profile Section -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

            @if (session('success_profile'))
                <div id="profileSuccess" class="bg-green-100 text-green-800 p-2 rounded mb-4">
                    {{ session('success_profile') }}
                </div>
                <script>
                    setTimeout(() => {
                        const alertBox = document.getElementById('profileSuccess');
                        if (alertBox) alertBox.style.display = 'none';
                    }, 2000);
                </script>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                           class="w-full border rounded px-3 py-2 mt-1">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                           class="w-full border rounded px-3 py-2 mt-1">
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Update Profile
                </button>
            </form>
        </div>

        <!-- Upload Document Section -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Upload Document</h2>

            @if (session('success_doc'))
                <div id="docSuccess" class="bg-green-100 text-green-800 p-2 rounded mb-4">
                    {{ session('success_doc') }}
                </div>
                <script>
                    setTimeout(() => {
                        const alertBox = document.getElementById('docSuccess');
                        if (alertBox) alertBox.style.display = 'none';
                    }, 2000);
                </script>
            @endif

            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="document" class="block text-gray-700 font-medium">Select Document (PDF, JPG, PNG)</label>
                    <input type="file" name="document" class="mt-1 p-2 w-full border rounded">
                    @error('document')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                    Upload
                </button>
            </form>

            <!-- Uploaded Documents -->
            <h3 class="text-lg font-semibold mb-2">Uploaded Documents</h3>
            @forelse ($documents as $doc)
                <div class="bg-gray-50 border p-3 rounded mb-2">
                    <p class="text-sm text-gray-800">
                        Status:
                        @if ($doc->status === 'pending')
                            <span class="text-yellow-600 font-semibold">Pending</span>
                        @elseif ($doc->status === 'approved')
                            <span class="text-green-600 font-semibold">Approved</span>
                        @elseif ($doc->status === 'rejected')
                            <span class="text-red-600 font-semibold">Rejected</span>
                        @endif
                    </p>

                    <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 text-sm hover:underline" onclick="return confirm('Delete this document?')">Delete</button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-gray-500">No documents uploaded yet.</p>
            @endforelse
        </div>
    </div>

</body>
</html>
