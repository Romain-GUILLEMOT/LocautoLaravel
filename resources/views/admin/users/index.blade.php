<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #6e40c9 0%, #8844ee 50%, #9f6eff 100%);
        }
        .box-bg {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .input-bg {
            background: rgba(255, 255, 255, 0.5);
        }
        .text-black {
            color: black;
        }
    </style>
</head>
<body class="bg-gradient text-black font-sans min-h-screen flex">
<nav class=" h-full flex flex-col justify-between">
    <div class="text-white text-justify mx-2 my-auto space-y-2">
        <a href="#dashboard" class="hover:scale-110 transform transition duration-300">Dashboard</a><br/>
        <a href="#users" class="hover:scale-110 transform transition duration-300">Users</a><br/>
        <a href="#invoices" class="hover:scale-110 transform transition duration-300">Invoices</a><br/>
        <a href="#cars" class="hover:scale-110 transform transition duration-300">Cars</a><br/>
        <a href="#reservations" class="hover:scale-110 transform transition duration-300">Reservations</a><br/>
    </div>
    <div class="mt-16 mb-2 self-end">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transform transition duration-300">Logout</button>
        </form>
    </div>
</nav>

<div class="container py-8 px-4 box-bg rounded-lg shadow-lg mx-auto mt-8">
    <h1 class="text-4xl font-bold mb-6 text-center">Users</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="search-form" method="GET" action="{{ route('users.index') }}" class="mb-6 flex space-x-2">
        <input type="text" id="search-input" name="search" placeholder="Search..." class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black w-full" value="{{ request('search') }}">
        <button type="submit" class="bg-blue-500 text-white p-3 rounded hover:bg-blue-600">Search</button>
    </form>

    <table class="min-w-full rounded-lg overflow-hidden shadow-lg">
        <thead class="bg-gray-100">
        <tr>
            <th class="py-4 px-6">First Name</th>
            <th class="py-4 px-6">Last Name</th>
            <th class="py-4 px-6">Email</th>
            <th class="py-4 px-6">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="bg-white hover:bg-gray-100 transition">
                <td class="py-4 px-6 border-b border-gray-300">{{ $user->first_name }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $user->last_name }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $user->email }}</td>
                <td class="py-4 px-6 border-b border-gray-300 flex space-x-2">
                    <button type="button" onclick="openModal({{ json_encode($user) }})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Details</button>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 text-black w-1/2 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">User Details</h2>
        <form id="modal-form" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium">First Name</label>
                <input type="text" id="first_name" name="first_name" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium">Address</label>
                <input type="text" id="address" name="address" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="city" class="block text-sm font-medium">City</label>
                <input type="text" id="city" name="city" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="postal_code" class="block text-sm font-medium">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="country" class="block text-sm font-medium">Country</label>
                <input type="text" id="country" name="country" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
            <button type="button" onclick="closeModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Close</button>
        </form>
    </div>
</div>

<script>
    function openModal(user) {
        document.getElementById('modal-form').action = `/admin/users/${user.id}`;
        document.getElementById('first_name').value = user.first_name;
        document.getElementById('last_name').value = user.last_name;
        document.getElementById('email').value = user.email;
        document.getElementById('address').value = user.address;
        document.getElementById('city').value = user.city;
        document.getElementById('postal_code').value = user.postal_code;
        document.getElementById('country').value = user.country;
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');
    }

    document.onkeydown = function(evt) {
        evt = evt || window.event;
        var isEscape = false;
        if ("key" in evt) {
            isEscape = (evt.key === "Escape" || evt.key === "Esc");
        } else {
            isEscape = (evt.keyCode === 27);
        }
        if (isEscape) {
            closeModal();
        }
    };

    document.getElementById('search-input').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('search-form').submit();
        }
    });

</script>
</body>
</html>
