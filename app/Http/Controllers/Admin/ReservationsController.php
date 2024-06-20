<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Car;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    private function getReservations(Request $request) {
        $reservations = Reservation::query()->with('user', 'car');
        if($request->search) {
            $search = $request->search;

            $reservations->where(function($query) use ($search) {
                $query->where('id', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%')
                            ->orWhere('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('car', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('model', 'like', '%' . $search . '%')
                            ->orWhere('brand', 'like', '%' . $search . '%');
                    });
            });
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
        return $reservations->paginate(20);
    }

    public function index(Request $request)
    {
        $reservations = $this->getReservations($request);
        $users = User::all();
        $cars = Car::all();
        return view('admin.reservations.index', compact('reservations', 'users', 'cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_in' => 'required|date',
            'date_out' => 'required|date',
            'status' => 'required|string|in:pending,closed,in_progress',
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
        ]);

        Reservation::create($validated);

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([

            'status' => 'required|string|in:pending,closed,in_progress',
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
        ]);
        if(!isset($validated['date_in'])) {
            $validated['date_in'] = $reservation->date_in;
        }
        if(!isset($validated['date_out'])) {
            $validated['date_out'] = $reservation->date_out;
        }
        $reservation->update($validated);

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Request $request, Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
