@extends('user.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<header class="mb-6 border-b border-gray-300 pb-4">
    <h1 class="text-3xl font-bold text-gray-900">Edit Profile</h1>
</header>

<div class="max-w-xl w-full bg-white p-6 rounded shadow mx-auto">

    @if (session('success'))
        <div id="successMessage" class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('successMessage');
                if (alertBox) alertBox.style.display = 'none';
            }, 2000);
        </script>
    @endif

    {{-- PROFILE PICTURE UPLOAD FORM --}}
    <form action="{{ route('profile.picture.upload') }}" method="POST" enctype="multipart/form-data" id="uploadPictureForm">
        @csrf
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>

            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden">

            <div id="profilePreviewWrapper">
                @if ($user->profile_picture)
                    <img
                        id="profilePreview"
                        src="{{ asset('storage/' . $user->profile_picture) }}"
                        alt="Profile Picture"
                        class="w-24 h-24 rounded-full object-cover border cursor-pointer"
                        title="Click to change profile picture"
                    >
                @else
                    <div id="profilePreview"
                         class="w-24 h-24 flex items-center justify-center bg-gray-200 text-gray-600 text-2xl font-semibold rounded-full border cursor-pointer"
                         title="Click to upload profile picture">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            @error('profile_picture')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </form>

    {{-- REMOVE PROFILE PICTURE FORM --}}
    @if ($user->profile_picture)
        <form action="{{ route('profile.picture.remove') }}" method="POST" class="mb-6 inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Are you sure you want to remove your profile picture?')"
                    class="text-red-600 text-sm hover:underline">
                Remove Profile Picture
            </button>
        </form>
    @endif

    {{-- PROFILE DETAILS UPDATE FORM --}}
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

<script>
    const profileWrapper = document.getElementById('profilePreviewWrapper');
    const fileInput = document.getElementById('profile_picture');
    const uploadForm = document.getElementById('uploadPictureForm');

    profileWrapper.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const previewImg = document.createElement('img');
            previewImg.src = URL.createObjectURL(file);
            previewImg.className = "w-24 h-24 rounded-full object-cover border cursor-pointer";
            previewImg.id = "profilePreview";
            previewImg.title = "Click to change profile picture";

            profileWrapper.innerHTML = '';
            profileWrapper.appendChild(previewImg);
            uploadForm.submit();
        }
    });
</script>
@endsection
