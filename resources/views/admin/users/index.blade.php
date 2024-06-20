<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient text-black font-sans min-h-screen flex">
@include('admin.navbar')

<!-- Contenu principal -->
<div class="container py-8 px-4 box-bg rounded-lg shadow-lg mx-auto mt-8">
    <h1 class="text-4xl font-bold mb-6 text-center">Utilisateurs</h1>
    <p class="text-black p-2 text-center">Pour ouvrir le menu veuillez appuyer sur <kbd>Ctrl+I</kbd> ou <kbd>Cmd+I</kbd>.</p>
    <div class="text-center mb-4">
        <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add User</button>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="search-form" method="GET" action="{{ route('admin.users.index') }}" class="mb-6 flex space-x-2">
        <input type="text" id="search-input" name="search" placeholder="Rechercher..." class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black w-full" value="{{ request('search') }}">
        <button type="submit" class="hidden">Recherche</button>
    </form>

    <table class="min-w-full rounded-lg overflow-hidden shadow-lg">
        <thead class="bg-gray-100">
        <tr>
            <th class="py-4 px-6">Prénom</th>
            <th class="py-4 px-6">Nom</th>
            <th class="py-4 px-6">Email</th>
            <th class="py-4 px-6">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="bg-white hover:bg-gray-100 transition">
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $user->first_name }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $user->last_name }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $user->email }}</td>
                <td class="py-4 px-6 border-b border-gray-300 flex space-x-2 justify-center">
                    <button type="button" onclick="openEditModal({{ json_encode($user) }})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Edit</button>
                    <button type="button" onclick="openConfirmDeleteModal({{ $user->id }})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

    @include('admin.users.modals.edit')
    @include('admin.users.modals.create')
    @include('admin.users.modals.delete')
</div>

<script>
    let userIdToDelete = null;

    function openConfirmDeleteModal(userId) {
        userIdToDelete = userId;
        document.getElementById('confirm-delete-modal').classList.remove('hidden');
    }

    function closeConfirmDeleteModal() {
        userIdToDelete = null;
        document.getElementById('confirm-delete-modal').classList.add('hidden');
    }

    document.getElementById('confirm-delete-button').addEventListener('click', function () {
        if (userIdToDelete) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/users/${userIdToDelete}`;
            form.innerHTML = `
                @csrf
            @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });

    function openEditModal(user) {
        document.getElementById('edit-modal').classList.remove('hidden');
        document.getElementById('edit-modal-form').action = `/admin/users/${user.id}`;
        document.getElementById('edit-first_name').value = user.first_name;
        document.getElementById('edit-last_name').value = user.last_name;
        document.getElementById('edit-email').value = user.email;
        document.getElementById('edit-address').value = user.address;
        document.getElementById('edit-city').value = user.city;
        document.getElementById('edit-postal_code').value = user.postal_code;
        document.getElementById('edit-country').value = user.country;
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }

    function openCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('create-modal').classList.add('hidden');
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let debounceTimeout;

        const searchInput = document.getElementById('search-input');
        const searchForm = document.getElementById('search-form');

        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                searchForm.submit();
            }, 1000); // 3000 ms = 3 seconds
        });


    });
</script>

</body>
</html>
