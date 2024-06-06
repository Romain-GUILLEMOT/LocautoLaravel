<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Reservation;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    private function getInvoices(Request $request) {
        $invoices = Invoice::query();
        if($request->search) {
            $invoices
                ->where('status', 'like', '%' . $request->search . '%');
        }
        if($request->from && $request->to) {
            $invoices->whereBetween('created_at', [$request->from, $request->to]);
        } elseif($request->from) {
            $invoices->whereDate('created_at', '>=', $request->from);
        } elseif($request->to) {
            $invoices->whereDate('created_at', '<=', $request->to);
        }
        //This take automatically page query parameters.
        $invoices = $invoices->paginate(20);
        //return users index view
        return $invoices;
    }
    public function index(Request $request)
    {
        $invoices = $this->getInvoices($request);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->all());
        $invoices = $this->getInvoices($request);
        return redirect()->route('invoices.index', compact('invoices'))->with('success', 'Invoice updated successfully');
    }
    public function destroy(Request $request, Invoice $invoice)
    {
        $invoice->delete();
        $invoices = $this->getInvoices($request);
        return redirect()->route('invoices.index', compact('invoices'))->with('success', 'Invoice deleted successfully');
    }

}
