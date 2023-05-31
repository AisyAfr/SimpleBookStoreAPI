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
}
