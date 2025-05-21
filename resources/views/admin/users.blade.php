<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <h2 class="text-2xl font-bold mb-6">Registered Users</h2>

    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('admin.users') }}" class="mb-6 flex flex-wrap items-center gap-4">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search by name or email"
               class="px-4 py-2 border rounded-lg w-64">

        <label class="flex items-center space-x-2">
            <input type="checkbox" name="has_proof" value="1"
                   {{ request('has_proof') ? 'checked' : '' }}>
            <span>Only With Proof</span>
        </label>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Search
        </button>
    </form>

    <!-- Users Table -->
    <div class="overflow-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Proof Document</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        @if($user->proof && $user->proof->document_path)
                            <a href="{{ asset('storage/' . $user->proof->document_path) }}" target="_blank"
                               class="text-blue-600 underline">
                               View Proof
                            </a>
                        @else
                            No Document
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->withQueryString()->links() }}
    </div>
</body>
</html>
