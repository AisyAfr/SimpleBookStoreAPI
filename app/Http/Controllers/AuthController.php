<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('logout');
    }


    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($user->email)->plainTextToken;
    }

    public function logout(Request $request){
        
        if($request->user()->currentAccessToken()->delete()){
            return response()->json(['message' => 'anda telah logout']); 
        } else {
            return response()->json()([
                'message' => 'error bang'
            ]);
        }
    }

    public function register(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|min:2|max:25',
            'firstname' => 'required|min:2|max:25',
            'lastname' => 'required|min:2|max:25',
            'password' => 'required|min:1|max:20',
        ]);

        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json()([
            'message' => 'kamu berhasil register!'
        ]);
    }
}
