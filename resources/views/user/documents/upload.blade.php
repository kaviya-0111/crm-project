@extends('user.layouts.app')

@section('title', 'Upload Documents')

@section('content')
<header class="mb-6 border-b border-gray-300 pb-4">
    <h1 class="text-3xl font-bold text-gray-900">Upload Documents</h1>
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

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="document_type" class="block text-sm font-medium text-gray-700">Document Type</label>
            <select name="document_type" id="document_type" class="w-full border rounded px-3 py-2 mt-1">
                <option value="ID Proof">ID Proof</option>
                <option value="Address Proof">Address Proof</option>
                <option value="Other">Other</option>
            </select>
            @error('document_type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="document" class="block text-sm font-medium text-gray-700">Choose File</label>
            <input type="file" name="document" id="document" class="w-full border rounded px-3 py-2 mt-1">
            @error('document')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            Upload
        </button>
    </form>
</div>
@endsection
