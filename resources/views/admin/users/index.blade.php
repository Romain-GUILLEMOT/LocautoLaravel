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
        #nav-wheel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            padding: 1rem 2rem;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        #nav-wheel a {
            margin: 0.5rem 0;
            font-size: 1.2rem;
            color: #6e40c9;
            text-decoration: none;
            transition: transform 0.3s ease, color 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            width: 100%;
            text-align: center;
        }
        #nav-wheel a:hover {
            transform: scale(1.05);
            color: #8844ee;
            background-color: rgba(110, 64, 201, 0.1);
        }
        #nav-wheel-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
        }
        kbd {
            background-color: #eee;
            border-radius: 3px;
            border: 1px solid #b4b4b4;
            box-shadow:
                0 1px 1px rgba(0, 0, 0, 0.2),
                0 2px 0 0 rgba(255, 255, 255, 0.7) inset;
            color: #333;
            display: inline-block;
            font-size: 0.85em;
            font-weight: 700;
            line-height: 1;
            padding: 2px 4px;
            white-space: nowrap;
        }
    </style>
</head>
<body class="bg-gradient text-black font-sans min-h-screen flex">
<div id="nav-wheel-bg"></div>
<nav id="nav-wheel">
    <a href="#dashboard">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="#users">
        <i class="fas fa-users"></i> Users
    </a>
    <a href="#invoices">
        <i class="fas fa-file-invoice"></i> Invoices
    </a>
    <a href="#cars">
        <i class="fas fa-car"></i> Cars
    </a>
    <a href="#reservations">
        <i class="fas fa-calendar-check"></i> Reservations
    </a>
</nav>

<!-- Contenu principal -->
<div class="container py-8 px-4 box-bg rounded-lg shadow-lg mx-auto mt-8">
    <h1 class="text-4xl font-bold mb-6 text-center">Users</h1>
    <p class="text-black p-2 text-center">To open the menu press <kbd>Ctrl+I</kbd> or <kbd>Cmd+I</kbd>.</p>

    <div class="text-center mb-4">
    </div>

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

    document.addEventListener('keydown', function(event) {
        if ((event.ctrlKey || event.metaKey) && event.key === 'i') {
            event.preventDefault();
            toggleNavWheel();
        } else if (event.key === 'Escape') {
            closeNavWheel();
            closeModal();
        }
    });

    function toggleNavWheel() {
        const navWheel = document.getElementById('nav-wheel');
        const navWheelBg = document.getElementById('nav-wheel-bg');
        if (navWheel.style.display === 'none' || navWheel.style.display === '') {
            navWheel.style.display = 'flex';
            navWheelBg.style.display = 'block';
        } else {
            navWheel.style.display = 'none';
            navWheelBg.style.display = 'none';
        }
    }

    function closeNavWheel() {
        document.getElementById('nav-wheel').style.display = 'none';
        document.getElementById('nav-wheel-bg').style.display = 'none';
    }

    document.getElementById('nav-wheel-bg').addEventListener('click', closeNavWheel);
</script>
</body>
</html>
