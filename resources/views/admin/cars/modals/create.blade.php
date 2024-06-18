<div id="create-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 text-black w-1/2 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Créer une voiture</h2>
        <form id="create-form" method="POST" action="{{ route('admin.cars.store') }}">
            @csrf
            <div class="mb-4">
                <label for="create-name" class="block text-sm font-medium">Nom</label>
                <input type="text" id="create-name" name="name" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-price" class="block text-sm font-medium">Prix</label>
                <input type="text" id="create-price" name="price" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-model" class="block text-sm font-medium">Modèle</label>
                <input type="text" id="create-model" name="model" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-date" class="block text-sm font-medium">Date</label>
                <input type="date" id="create-date" name="date" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-brand" class="block text-sm font-medium">Marque</label>
                <input type="text" id="create-brand" name="brand" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-state" class="block text-sm font-medium">État</label>
                <input type="text" id="create-state" name="state" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Créer</button>
            <button type="button" onclick="closeCreateModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Fermer</button>
        </form>
    </div>
</div>
