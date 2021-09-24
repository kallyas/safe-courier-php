<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showAllUsers()
    {
        return response()->json(User::all());
    }

    public function showOneUser($id)
    {
        return response()->json(User::find($id));
    }

    public function createUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'firstName' => 'required',
            'lastName' => 'required',
            'password' => 'required'
        ]);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function updateUser($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return response('Deleted successfully', 200);
    }

    // function to login a user
    public function loginUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (Hash::check($request->password, $user->password)) {
            return response()->json(['user' => $user, 'token' => $user->createToken('MyApp')->accessToken], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
