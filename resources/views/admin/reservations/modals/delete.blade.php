<div id="confirm-delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 text-black w-1/2 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this reservation? This action cannot be undone.</p>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeConfirmDeleteModal()" class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
            <button type="button" id="confirm-delete-button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
        </div>
    </div>
</div>
