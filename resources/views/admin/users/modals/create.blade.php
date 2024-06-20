<div id="create-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 text-black w-1/2 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Create User</h2>
        <form id="create-modal-form" method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="mb-4">
                <label for="create-first_name" class="block text-sm font-medium">First Name</label>
                <input type="text" id="create-first_name" name="first_name" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
            </div>
            <div class="mb-4">
                <label for="create-last_name" class="block text-sm font-medium">Last Name</label>
                <input type="text" id="create-last_name" name="last_name" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
            </div>
            <div class="mb-4">
                <label for="create-email" class="block text-sm font-medium">Email</label>
                <input type="email" id="create-email" name="email" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
            </div>
            <div class="mb-4">
                <label for="create-address" class="block text-sm font-medium">Address</label>
                <input type="text" id="create-address" name="address" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-city" class="block text-sm font-medium">City</label>
                <input type="text" id="create-city" name="city" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-postal_code" class="block text-sm font-medium">Postal Code</label>
                <input type="text" id="create-postal_code" name="postal_code" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-country" class="block text-sm font-medium">Country</label>
                <input type="text" id="create-country" name="country" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black">
            </div>
            <div class="mb-4">
                <label for="create-password" class="block text-sm font-medium">Password</label>
                <input type="password" id="create-password" name="password" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create</button>
            <button type="button" onclick="closeCreateModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Close</button>
        </form>
    </div>
</div>
