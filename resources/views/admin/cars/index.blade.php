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
        <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter une voiture</button>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="search-form" method="GET" action="{{ route('admin.cars.index') }}" class="mb-6 flex space-x-2">
        <input type="text" id="search-input" name="search" placeholder="Rechercher..." class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black w-full" value="{{ request('search') }}">
        <button type="submit" class="bg-blue-500 text-white p-3 rounded hover:bg-blue-600">Rechercher</button>
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
            <th class="py-4 px-6">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr class="bg-white hover:bg-gray-100 transition">
                <td class="py-4 px-6 border-b border-gray-300">{{ $car->name }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $car->price }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $car->model }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $car->date }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $car->brand }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $car->state }}</td>
                <td class="py-4 px-6 border-b border-gray-300">{{ $car->available ? "oui" : "non" }}</td>

                <td class="py-4 px-6 border-b border-gray-300 flex space-x-2">
                    <button type="button" onclick="openModal({{ json_encode($car) }})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Détails</button>
                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $cars->links() }}
    </div>

    @include('admin.cars.modals.details')
    @include('admin.cars.modals.create')
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
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
</body>
</html>
