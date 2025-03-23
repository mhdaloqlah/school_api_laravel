<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',

        ]);

        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'login information invalid',

            ], 401);
        }

        $user = User::where('username', $validated['username'])->first();

        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
            'data' => $user,
            'user_type' => $user->type,
            'message' => 'login successfully'
        ], 200);
    }

    public function register(Request $request)
    {


        $validateUser = Validator::make(
            $request->all(),
            [
                'username' => 'required|max:255|unique:users,username',
                'password' => 'required|confirmed|min:6',
                'type' => 'required'
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'type' => $request->type

        ]);


        $success['token'] = $user->createToken('api_token')->plainTextToken;
        $success['token_type'] = 'Bearer';
        $success['userdata'] = $user;
        $success['success'] = true;

        // $user->notify(new EmailVarificationNotification);
        return response()->json($success, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'successfully logged out'
        ]);
    }
}
