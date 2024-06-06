<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    private function getReservations(Request $request) {
        $reservations = Reservation::query();
        if($request->search) {
            $reservations
                ->where('status', 'like', '%' . $request->search . '%');
        }
        if($request->sort && in_array($request->sort, ['date_in', 'date_out'])) {
            if($request->from && $request->to) {
                $reservations->whereBetween($request->sort, [$request->from, $request->to]);
            } elseif($request->from) {
                $reservations->whereDate($request->sort, '>=', $request->from);
            } elseif($request->to) {
                $reservations->whereDate($request->sort, '<=', $request->to);
            }
        }

        //This take automatically page query parameters.
        $reservations = $reservations->paginate(20);
        //return users index view
        return $reservations;
    }
    public function index(Request $request)
    {
        $reservations = $this->getReservations($request);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update($request->all());
        $reservations = $this->getReservations($request);
        return redirect()->route('reservations.index', compact('reservations'))->with('success', 'Reservation updated successfully');

    }
    public function destroy(Request $request, Reservation $reservation)
    {
        $reservation->delete();
        $reservations = $this->getReservations($request);
        return redirect()->route('reservations.index', compact('reservations'))->with('success', 'Reservation deleted successfully');

    }

}
