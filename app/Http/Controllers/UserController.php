<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(User $user)
    {
        if ($user->whereEmail(request()->input("email"))->first()) {
            return response()->json("This email already exists", 409);
        }

        $data = $user->create(request()->all());

        return response()->json($data, 201);
    }

    public function login()
    {
        if (!Auth::attempt(["email" => request()->input("email"), "password" => request()->input("password")])) {
            return response()->json("Invalid login or password", 401);
        }

        $user = Auth::user();

        return response()->json($user);
    }

    public function get(User $user, $userId)
    {
        $users = $user->where("id", '!=', $userId)->get();

        return response()->json($users);
    }
}
