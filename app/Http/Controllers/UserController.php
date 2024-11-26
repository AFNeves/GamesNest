<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Store a new user directly with the provided data.
     *
     * @param array $data
     * @return User
     */
    public static function storeDirect(array $data): User
    {
        return User::create($data);
    }

    /**
     * Show the list of all users.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the details of a specific user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Update a user's information.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|min:5|max:20|unique:users,username,' . $id,
            'email' => 'sometimes|string|max:255|email|unique:users,email,' . $id,
        ]);

        $user->update($data);

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    /**
     * Delete a user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
