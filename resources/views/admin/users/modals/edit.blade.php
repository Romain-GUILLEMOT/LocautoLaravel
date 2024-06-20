<div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 text-black w-1/2 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Modifier un utilisateur</h2>
        <form id="edit-modal-form" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit-first_name" class="block text-sm font-medium">Prénom</label>
                <input type="text" id="edit-first_name" name="first_name" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="edit-last_name" class="block text-sm font-medium">Nom de famille</label>
                <input type="text" id="edit-last_name" name="last_name" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="edit-email" class="block text-sm font-medium">Email</label>
                <input type="email" id="edit-email" name="email" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="edit-address" class="block text-sm font-medium">Adresse</label>
                <input type="text" id="edit-address" name="address" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="edit-city" class="block text-sm font-medium">Ville</label>
                <input type="text" id="edit-city" name="city" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="edit-postal_code" class="block text-sm font-medium">Code Postal</label>
                <input type="text" id="edit-postal_code" name="postal_code" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="edit-country" class="block text-sm font-medium">Pays</label>
                <input type="text" id="edit-country" name="country" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Sauvegarder</button>
            <button type="button" onclick="closeEditModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Fermer</button>
        </form>
    </div>
</div>
