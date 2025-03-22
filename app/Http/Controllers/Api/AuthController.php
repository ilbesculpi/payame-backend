<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if( !Auth::attempt($credentials) ) {
            return response()->json([
                'result' => false,
            ]);
        }

        $user = Auth::user();
        // issue a new token
        $access_token = $user->createToken('app');
        return response()->json([
            'result' => true,
            'user' => $user,
            'access_token' => $access_token->plainTextToken,
        ]);
    }

}
