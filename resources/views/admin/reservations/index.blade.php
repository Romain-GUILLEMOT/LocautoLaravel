<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient text-black font-sans min-h-screen flex">
@include('admin.navbar')

<div class="container py-8 px-4 box-bg rounded-lg shadow-lg mx-auto mt-8">
    <h1 class="text-4xl font-bold mb-6 text-center">Reservations</h1>
    <p class="text-black p-2 text-center">Pour ouvrir le menu veuillez appuyer sur <kbd>Ctrl+I</kbd> ou <kbd>Cmd+I</kbd>.</p>

    <div class="text-center mb-4">
        <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter une Reservation</button>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="search-form" method="GET" action="{{ route('admin.reservations.index') }}" class="mb-6 flex space-x-2">
        <input type="text" id="search-input" name="search" placeholder="Search by status..." class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black w-full" value="{{ request('search') }}">
        <select name="sort" class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            <option value="" disabled selected>Trier par</option>
            <option value="date_in" {{ request('sort') == 'date_in' ? 'selected' : '' }}>Date d'entrer</option>
            <option value="date_out" {{ request('sort') == 'date_out' ? 'selected' : '' }}>Date de sortie</option>
        </select>
        <input type="date" name="from" class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black" value="{{ request('from') }}">
        <input type="date" name="to" class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black" value="{{ request('to') }}">
        <button type="submit" class="hidden">Recherche</button>
    </form>

    <table class="min-w-full rounded-lg overflow-hidden shadow-lg">
        <thead class="bg-gray-100">
        <tr>
            <th class="py-4 px-6">Id</th>
            <th class="py-4 px-6">Utilisateur</th>
            <th class="py-4 px-6">Voiture</th>
            <th class="py-4 px-6">Date d'entrer</th>
            <th class="py-4 px-6">Date de sortie</th>
            <th class="py-4 px-6">Status</th>
            <th class="py-4 px-6">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            <tr class="bg-white hover:bg-gray-100 transition">
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $reservation->id }}</td>

                <td class="py-4 px-6 border-b border-gray-300 text-center text-blue-600 underline"><a href={{"/admin/users?search=" . $reservation->user->id}}>{{ $reservation->user->first_name }} {{ $reservation->user->last_name }}</a></td>
                <td class="py-4 px-6 border-b border-gray-300 text-center text-blue-600 underline"><a href={{"/admin/cars?search=" . $reservation->car->id}}>{{ $reservation->car->model }}</a></td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $reservation->date_in }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $reservation->date_out }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">
                    @if ($reservation->status == 'in_progress')
                        <i class="fas fa-clock text-yellow-500"></i>
                    @elseif ($reservation->status == 'closed')
                        <i class="fas fa-check-circle text-green-500"></i>
                    @elseif ($reservation->status == 'pending')
                        <i class="fas fa-hourglass-half text-blue-500"></i>
                    @endif
                </td>
                <td class="py-4 px-6 border-b border-gray-300 flex space-x-2 justify-center">
                    <button type="button" onclick="openEditModal({{ json_encode($reservation) }})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Modifier</button>
                    <button type="button" onclick="openConfirmDeleteModal({{ $reservation->id }})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Supprimer</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $reservations->links() }}
    </div>

    @include('admin.reservations.modals.create')
    @include('admin.reservations.modals.edit')
    @include('admin.reservations.modals.delete')
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let reservationIdToDelete = null;

    function openConfirmDeleteModal(reservationId) {
        reservationIdToDelete = reservationId;
        document.getElementById('confirm-delete-modal').classList.remove('hidden');
    }

    function closeConfirmDeleteModal() {
        reservationIdToDelete = null;
        document.getElementById('confirm-delete-modal').classList.add('hidden');
    }

    document.getElementById('confirm-delete-button').addEventListener('click', function () {
        if (reservationIdToDelete) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/reservations/${reservationIdToDelete}`;
            form.innerHTML = `
                @csrf
            @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });

    function openEditModal(reservation) {
        document.getElementById('edit-modal').classList.remove('hidden');
        document.getElementById('edit-modal-form').action = `/admin/reservations/${reservation.id}`;
        document.getElementById('edit-date_in').value = reservation.date_in;
        document.getElementById('edit-date_out').value = reservation.date_out;
        document.getElementById('edit-status').value = reservation.status;
        document.getElementById('edit-car_id').value = reservation.car_id;
        document.getElementById('edit-user_id').value = reservation.user_id;

        flatpickr("#edit-date_in", {
            dateFormat: "Y-m-d",
        });
        flatpickr("#edit-date_out", {
            dateFormat: "Y-m-d",
        });
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }

    function openCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');

        flatpickr("#create-date_in", {
            dateFormat: "Y-m-d",
        });
        flatpickr("#create-date_out", {
            dateFormat: "Y-m-d",
        });
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
            }, 1000);
        });
    });
</script>
</body>
</html>
