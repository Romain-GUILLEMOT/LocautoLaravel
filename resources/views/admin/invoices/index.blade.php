<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factures</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient text-black font-sans min-h-screen flex">
@include('admin.navbar')

<div class="container py-8 px-4 box-bg rounded-lg shadow-lg mx-auto mt-8">
    <h1 class="text-4xl font-bold mb-6 text-center">Factures</h1>
    <p class="text-black p-2 text-center">Pour ouvrir le menu veuillez appuyer sur <kbd>Ctrl+I</kbd> ou <kbd>Cmd+I</kbd>.</p>

    <div class="text-center mb-4">
        <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter une facture</button>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="search-form" method="GET" action="{{ route('admin.invoices.index') }}" class="mb-6 flex space-x-2">
        <input type="text" id="search-input" name="search" placeholder="Rechercher par statut..." class="p-3 rounded border border-gray-300 bg-white bg-opacity-50 text-black w-full" value="{{ request('search') }}">
        <label class="flex items-center space-x-2">
            <input id="trashed-checkbox" type="checkbox" name="trashed" {{ request('trashed') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Afficher supprimés</span>
        </label>
        <button type="submit" class="hidden">Rechercher</button>
    </form>

    <table class="min-w-full rounded-lg overflow-hidden shadow-lg">
        <thead class="bg-gray-100">
        <tr>
            <th class="py-4 px-6">Utilisateur</th>
            <th class="py-4 px-6">Réservation</th>
            <th class="py-4 px-6">Montant</th>
            <th class="py-4 px-6">Statut</th>
            @if(!$invoice->trashed())

            <th class="py-4 px-6">Actions</th>
            @endif

        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr class="bg-white hover:bg-gray-100 transition">
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $invoice->user->first_name }} {{ $invoice->user->last_name }}</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center text-blue-600 underline"><a href={{"/admin/reservations?search=" . $invoice->reservation->id}} >{{ $invoice->reservation->id }}</a></td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">{{ $invoice->reservation->car->price }}€</td>
                <td class="py-4 px-6 border-b border-gray-300 text-center">                    {!! $invoice->status ? '<i class="fas fa-check text-green-500 mx-auto"></i>' : '<i class="fas fa-times text-red-500 mx-auto"></i>' !!}
                </td>
                @if(!$invoice->trashed())

                <td class="py-4 px-6 border-b border-gray-300 flex space-x-2 justify-center">
                    <button type="button" onclick="openEditModal({{ json_encode($invoice) }})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Modifier</button>
                        <button type="button" onclick="openConfirmDeleteModal({{ $invoice->id }})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Supprimer</button>
                </td>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $invoices->links() }}
    </div>

    @include('admin.invoices.modals.create')
    @include('admin.invoices.modals.edit')
    @include('admin.invoices.modals.delete')
</div>

<script>
    let invoiceIdToDelete = null;

    function openConfirmDeleteModal(invoiceId) {
        invoiceIdToDelete = invoiceId;
        document.getElementById('confirm-delete-modal').classList.remove('hidden');
    }

    function closeConfirmDeleteModal() {
        invoiceIdToDelete = null;
        document.getElementById('confirm-delete-modal').classList.add('hidden');
    }

    document.getElementById('confirm-delete-button').addEventListener('click', function () {
        if (invoiceIdToDelete) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/invoices/${invoiceIdToDelete}`;
            form.innerHTML = `
                @csrf
            @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });

    function openEditModal(invoice) {
        document.getElementById('edit-modal').classList.remove('hidden');
        document.getElementById('edit-modal-form').action = `/admin/invoices/${invoice.id}`;
        document.getElementById('edit-user_id').value = invoice.user_id;
        document.getElementById('edit-reservation_id').value = invoice.reservation_id;
        document.getElementById('edit-status').value = invoice.status;
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }

    function openCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('create-modal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        let debounceTimeout;

        const searchInput = document.getElementById('search-input');
        const trashedCheckbox = document.getElementById('trashed-checkbox');
        const searchForm = document.getElementById('search-form');

        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                searchForm.submit();
            }, 1000);
        });

        trashedCheckbox.addEventListener('change', function () {
            searchForm.submit();
        });
    });
</script>
</body>
</html>
