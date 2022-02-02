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

        // hash user password 
        $password = Hash::make($request->input('password'));
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'password' => $password
        ]);
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
        if(!$user) {
            return response()->json([
                'status' => 'failure',
                'error' => 'Email does not exist.'
            ], 401);
        }
        if (Hash::check($request->password, $user->password)) {
            $api_token = base64_encode(random_bytes(40));
            User::where('email', $request->email)->update(['api_key' => $api_token]);
            return response()->json(['status' => 'sucess', 'api_token' => $api_token], 200);  

        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
