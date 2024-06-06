<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Request;

class ReservationController extends Controller
{
    private function getUsers(Request $request) {
        $reservations = Reservation::query();
        if($request->search) {
            $reservations
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('postal_code', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%')
                ->orWhere('city', 'like', '%' . $request->search . '%')
                ->orWhere('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%');
        }
        //This take automatically page query parameters.
        $reservations = $reservations->paginate(20);
        //return users index view
        return $reservations;
    }
    public function index(Request $request)
    {
        $users = $this->getUsers($request);
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $users = $this->getUsers($request);

        return redirect()->route('admin.users.index', compact('users'))->with('success', 'User updated successfully');
    }
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $users = $this->getUsers($request);

        return redirect()->route('admin.users.index',  compact('users'))->with('success', 'User deleted successfully');
    }

}
