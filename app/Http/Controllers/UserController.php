<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAll()
    {
       return User::all();
    }
    public function register(Request $request)
    {
        try {
            $body = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
            ]);
            $body['password'] = Hash::make($body['password']);
            $user = User::create($body);
            return response($user, 201);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
            ]);
            if (!Auth::attempt($credentials)) {
                return response(['message' => 'Wrong Credentials'], 400);
                //  return res.status(400).send({
                //     message:'Wrong Credentials'
                // })
            }
            $user = Auth::user(); //req.user, $request->user()
            $token = $user->createToken('authToken')->accessToken;
            return response([
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }
}
