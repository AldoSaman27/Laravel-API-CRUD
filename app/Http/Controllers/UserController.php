<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware("auth:sanctum",['except'=>["login", "register"]]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|string",
            "password" => "required",
        ]);

        if(!Auth::attempt($request->only("email", "password"))) {
            return response()->json(['message' => "Salah"]);
        }

        $user=User::where("email", $request->email)->first();
        $token=$user->createToken("token")->plainTextToken;

        $token = $token;

        return response()->json([
            'message' => "suksess",
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "level" => $user->level,
            "token" => $token,
        ]);
    }        

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => "logout berhasil"]);
    }
}

