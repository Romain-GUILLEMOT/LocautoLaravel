<div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 text-black w-1/2 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Edit Reservation</h2>
        <form id="edit-modal-form" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit-date_in" class="block text-sm font-medium">Date In</label>
                <input type="date" id="edit-date_in" name="date_in" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
                @error('date_in')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="edit-date_out" class="block text-sm font-medium">Date Out</label>
                <input type="date" id="edit-date_out" name="date_out" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
                @error('date_out')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="edit-status" class="block text-sm font-medium">Status</label>
                <select id="edit-status" name="status" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="closed">Closed</option>
                </select>
                @error('status')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="edit-car_id" class="block text-sm font-medium">Car</label>
                <select id="edit-car_id" name="car_id" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->model }}</option>
                    @endforeach
                </select>
                @error('car_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="edit-user_id" class="block text-sm font-medium">User</label>
                <select id="edit-user_id" name="user_id" class="mt-1 p-2 w-full rounded border border-gray-300 bg-white bg-opacity-50 text-black" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
            <button type="button" onclick="closeEditModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Close</button>
        </form>
    </div>
</div>
