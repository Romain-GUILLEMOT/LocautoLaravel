<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private function getUsers(Request $request) {
        $users = User::query();
        if($request->search) {
            $users
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('postal_code', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%')
                ->orWhere('city', 'like', '%' . $request->search . '%')
                ->orWhere('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%');
        }
        //This take automatically page query parameters.
        //return users index view
        return $users->paginate(20);
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

        return redirect()->route('users.index', compact('users'))->with('success', 'User updated successfully');
    }
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $users = $this->getUsers($request);

        return redirect()->route('admin.users.index',  compact('users'))->with('success', 'User deleted successfully');
    }

}
