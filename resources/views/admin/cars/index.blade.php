<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voitures</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient text-black font-sans min-h-screen flex">
@include('admin.navbar')

<!-- Contenu principal -->
<div class="container py-8 px-4 box-bg rounded-lg shadow-lg mx-auto mt-8">
    <h1 class="text-4xl font-bold mb-6 text-center">Voitures</h1>
    <p class="text-black p-2 text-center">Pour ouvrir le menu, appuyez sur <kbd>Ctrl+I</kbd> ou <kbd>Cmd+I</kbd>.</p>

    <div class="text-center mb-4">
        <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter
            une voiture
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="search-form" method="GET" action="{{ route('admin.cars.index') }}" class="mb-6 flex space-x-2">
        <input type="text" id="search-input" name="search" placeholder="Rechercher..."
               class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black w-full"
               value="{{ request('search') }}">

        <select id="availability-select" name="availability"
                class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            <option value="all" {{ request('availability') == 'all' ? 'selected' : '' }}>ALL</option>
            <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Only available
            </option>
            <option value="not_available" {{ request('availability') == 'not_available' ? 'selected' : '' }}>Only not
                available
            </option>
        </select>

        <label class="flex items-center space-x-2">
            <input id="archived-checkbox" type="checkbox" name="archived"
                   {{ request('archived') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Afficher supprimer</span>
        </label>

        <button type="submit" class="hidden">Rechercher</button>
    </form>


    <table class="min-w-full rounded-lg overflow-hidden shadow-lg">
        <thead class="bg-gray-100">
        <tr>
            <th class="py-4 px-6">Nom</th>
            <th class="py-4 px-6">Prix</th>
            <th class="py-4 px-6">Modèle</th>
            <th class="py-4 px-6">Date</th>
            <th class="py-4 px-6">Marque</th>
            <th class="py-4 px-6">État</th>
            <th class="py-4 px-6">Disponible</th>
            @if(!$car->trashed())

            <th class="py-4 px-6">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr class="bg-white hover:bg-gray-100 transition">
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $car->name }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $car->price }}€</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $car->model }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $car->date }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $car->brand }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $car->state }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">
                    {!! $car->available ? '<i class="fas fa-check text-green-500 mx-auto"></i>' : '<i class="fas fa-times text-red-500 mx-auto"></i>' !!}
                </td>

                @if(!$car->trashed())

                <td class="py-4 px-6 border-b border-gray-300 flex space-x-2 justify-center">
                    <button type="button" onclick="openModal({{ json_encode($car) }})"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Détails
                    </button>
                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline-block">

                        <button type="button" onclick="openConfirmDeleteModal({{ $car->id }})"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Supprimer
                        </button>
                    </form>
                </td>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $cars->links() }}
    </div>

    @include('admin.cars.modals.edit')
    @include('admin.cars.modals.create')
    @include('admin.cars.modals.delete')

</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let carIdToDelete = null;

    function openConfirmDeleteModal(carId) {
        carIdToDelete = carId;
        document.getElementById('confirm-delete-modal').classList.remove('hidden');
    }

    function closeConfirmDeleteModal() {
        carIdToDelete = null;
        document.getElementById('confirm-delete-modal').classList.add('hidden');
    }

    document.getElementById('confirm-delete-button').addEventListener('click', function () {
        if (carIdToDelete) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/cars/${carIdToDelete}`;
            form.innerHTML = `
                @csrf
            @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });

    function openModal(car) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal-form').action = `/admin/cars/${car.id}`;
        document.getElementById('name').value = car.name;
        document.getElementById('price').value = car.price;
        document.getElementById('model').value = car.model;
        document.getElementById('date').value = car.date;
        document.getElementById('brand').value = car.brand;
        document.getElementById('state').value = car.state;
        document.getElementById('available').checked = !!car.available;

    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function openCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');
        flatpickr("#create-date", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true
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
        const availabilitySelect = document.getElementById('availability-select');
        const archivedCheckbox = document.getElementById('archived-checkbox');
        const searchForm = document.getElementById('search-form');

        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                searchForm.submit();
            }, 1000); // 3000 ms = 3 seconds
        });

        availabilitySelect.addEventListener('change', function () {
            searchForm.submit();
        });

        archivedCheckbox.addEventListener('change', function () {
            searchForm.submit();
        });
    });
</script>

</body>
</html>
