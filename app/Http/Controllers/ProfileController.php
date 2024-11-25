<?php
namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller{
    public function show(string $id) : View{

        $user = User::findOrFail($id);

        return view('pages.profileshow', ['user' => $user]);
    }

    public function edit_profile(string $id) : View{

        $user = User::findOrFail($id);

        return view('pages.editprofile', ['user' => $user]);
    }
    public function update_profile(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|min:5|max:255|unique:users,username,'.$id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string',
            'password confirmation' => 'nullable|string|same:password',
        ]);

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if($request->password){
            $user->password = $request->password;
        }
        $user->save();

        return redirect()->route('profile', ['id' => $user])->with('success', 'Profile updated successfully!');
    }
}