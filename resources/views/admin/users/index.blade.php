<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black-bg text-light-text-violet font-sans">
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Users</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6">
        <input type="text" name="search" placeholder="Search..." class="p-2 rounded border border-light-violet bg-box-violet text-white w-full">
        <button type="submit" class="mt-2 bg-button-violet text-white p-2 rounded w-full">Search</button>
    </form>

    <table class="min-w-full bg-secondary-box-violet rounded">
        <thead>
        <tr class="w-full">
            <th class="py-2 px-4 border-b border-light-violet">Name</th>
            <th class="py-2 px-4 border-b border-light-violet">Email</th>
            <th class="py-2 px-4 border-b border-light-violet">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="py-2 px-4 border-b border-light-violet">{{ $user->name }}</td>
                <td class="py-2 px-4 border-b border-light-violet">{{ $user->email }}</td>
                <td class="py-2 px-4 border-b border-light-violet">
                    <button onclick="openModal({{ json_encode($user) }})" class="bg-blue-500 text-white px-4 py-2 rounded">Details</button>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden justify-center items-center">
    <div class="bg-secondary-box-violet rounded p-6 text-white w-1/2">
        <h2 class="text-2xl font-bold mb-4">User Details</h2>
        <form id="modal-form" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium">First Name</label>
                <input type="text" id="first_name" name="first_name" class="mt-1 p-2 w-full rounded border border-light-violet bg-box-violet text-white">
            </div>
            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="mt-1 p-2 w-full rounded border border-light-violet bg-box-violet text-white">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" class="mt-1 p-2 w-full rounded border border-light-violet bg-box-violet text-white">
            </div>
            <button type="submit" class="mt-4 bg-button-violet text-white px-4 py-2 rounded">Save</button>
            <button type="button" onclick="closeModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
        </form>
    </div>
</div>

<script>
    function openModal(user) {
        document.getElementById('modal-form').action = `/admin/users/${user.id}`;
        document.getElementById('first_name').value = user.first_name;
        document.getElementById('last_name').value = user.last_name;
        document.getElementById('email').value = user.email;
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>
</body>
</html>
