<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search by name or email"
               value="{{ request('search') }}"
               class="px-4 py-2 border rounded w-1/3">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Search</button>
    </form>

    <div class="bg-white rounded shadow p-4">
        <table class="w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Proof Document</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                           @if ($user->document_path && Storage::disk('public')->exists($user->document_path))
    <a href="{{ asset('storage/' . $user->document_path) }}" class="text-blue-600 underline" target="_blank">View Proof</a>
@else
    <span class="text-red-500">Not Uploaded</span>
@endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-4">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

</body>
</html>
