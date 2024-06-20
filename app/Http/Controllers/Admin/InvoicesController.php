<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::with('reservation.car', 'user')
            ->when($request->trashed, function ($query) {
                return $query->onlyTrashed();
            })
            ->paginate(20);

        $users = User::all();
        $reservations = Reservation::with('car')->get();

        return view('admin.invoices.index', compact('invoices', 'users', 'reservations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'reservation_id' => 'required|exists:reservations,id',
            'status' => 'required|string|in:pending,paid',
        ]);

        Invoice::create($validated);

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'reservation_id' => 'required|exists:reservations,id',
            'status' => 'required|string|in:pending,paid',
        ]);

        $invoice->update($validated);

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function restore($id)
    {
        Invoice::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice restored successfully.');
    }
}
