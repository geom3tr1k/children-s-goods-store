<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function reg(Request $request) {
        $request->validate([
            'email' => 'email|required|unique:users,email',
            'password' => 'required',
            'lastName' => 'required',
            'firstName' => 'required'
        ]);
        $user = User::create([
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
            'lastName' => $request -> lastName,
            'firstName' => $request -> firstName
        ]);
        $token = $user -> createToken('API Token') -> plainTextToken;
        return response() -> json([
            "message"=> "User registered successfully",
            "token" => $token
        ]);
    }

    public function authorisation(Request $request) {
        $request -> validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email) -> first();
        if($user && Hash::check($request->password, $user->password)) {
             return response() -> json([
                "status" => 200,
                "message" => "Login successful",
                "token" => $user -> createToken('API Token') -> plainTextToken
            ], 200);
        }
        return response() -> json([
            "messege" => 'Invalid email or password'
        ], 401);
    }

    public function logOut(Request $request) {
        try {
            $request -> user() -> curretAccessToken()->delete();
            return response() -> json([
                "messange" => 'Login out'
            ], 201);
        } catch(Exception $e) {
            return response() -> json([
                'messange' => 'Faild'
            ], 401);
        }
    }
}
