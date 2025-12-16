<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function reg(Request $request)
    {
        $request->validate([
            'email' => 'email|required|unique:users,email',
            'password' => 'required',
            'lastName' => 'required',
            'firstName' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = 'avatars/default.png';
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'avatar' => $avatarPath
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            "message" => "User registered successfully",
            "token" => $token,
            "role" => $user->role,
            "avatar" => asset('storage/' . $avatarPath)
        ]);
    }

    public function authorisation(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => 200,
                "message" => "Login successful",
                "role" => $user->role,
                "token" => $user->createToken('API Token')->plainTextToken
            ], 200);
        }
        return response()->json([
            "messege" => 'Invalid email or password'
        ], 401);
    }

    public function logOut(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                "messange" => 'Login out'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'messange' => 'Faild'
            ], 401);
        }
    }


    public function uploadUser(Request $request, string $id)
    {
        $user = User::find($id);
        $validateDate = $request->validate([
            'email' => 'sometimes|email',
            'password' => 'sometimes',
            'lastName' => 'sometimes',
            'firstName' => 'sometimes',
            'avatar' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $userId = Auth::id();
        if ($user->id !== $userId) {
            return response()->json([
                "messange" => "Вы не автор"
            ]);
        }
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = 'avatars/default.png';
        }
        $validateDate['avatar'] = $avatarPath;
        $user->update($validateDate);
        return  response()->json([
            "messenge" => "Upload"
        ]);
    }

    public function setAdmin(Request $request, string $id)
    {
        $user = $request->user();
        if ($user->role !== 'root') {
            return response()->json([
                "messenge" => "Вы не имеете доступ к данной функции"
            ]);
        };

        $setAdminUser = User::find($id);

        if (!$setAdminUser) {
            return response()->json([
                "messenge" => "Данного пользователя нет"
            ]);
        };

        if ($setAdminUser->role == 'root') {
            return response()->json([
                "messenge" => "Вы уже админ самый крутой"
            ]);
        }

        if ($setAdminUser->role == 'admin') {
            return response()->json([
                "messenge" => "Вы уже админ"
            ]);
        }

        $setAdminUser->role = 'admin';
        $setAdminUser->save();

        return response()->json([
            "messenge" => "Успешно"
        ]);
    }

        public function delAdmin(Request $request, string $id)
    {
        $user = $request->user();
        if ($user->role !== 'root') {
            return response()->json([
                "messenge" => "Вы не имеете доступ к данной функции"
            ]);
        };

        $setAdminUser = User::find($id);

        if (!$setAdminUser) {
            return response()->json([
                "messenge" => "Данного пользователя нет"
            ]);
        };

        if ($setAdminUser->role == 'root') {
            return response()->json([
                "messenge" => "Вы уже админ самый крутой"
            ]);
        }

        if ($setAdminUser->role == 'user') {
            return response()->json([
                "messenge" => "Вы уже итак не админ"
            ]);
        }

        $setAdminUser->role = 'user';
        $setAdminUser->save();

        return response()->json([
            "messenge" => "Успешно"
        ]);
    }
    public function getAdmins(Request $request){

        $user = $request -> user();

        if($user -> role !== "root" && $user -> role !== "admin") {
            return response() -> json([
                "messenge" => "Вы не имеете доступ"
            ]);
        }
        return response()->json(User::where('role', 'admin')->get());
    }
    public function getUsers(Request $request){

        $user = $request -> user();

        if($user -> role !== "root" && $user -> role !== "admin") {
            return response() -> json([
                "messenge" => "Вы не имеете доступ"
            ]);
        }
        return response()->json(User::where('role', 'user')->get());
    }
}
