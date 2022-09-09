<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
    }

    public function login(LoginRequest $request)
    {
        $jwtToken = null;
        if (!$jwtToken = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $payload = [
            'name'     => auth()->user()->name,
            'role'     => auth()->user()->role,
            'email'    => auth()->user()->email,
            'id'       => auth()->user()->id,
            'username' => auth()->user()->username
        ];

        return response()->json([
            'success' => true,
            'user'    => $payload,
        ])->withCookie('token', $jwtToken, config('jwt.ttl'), '/', null, false, true);
    }

    public function logout()
    {

    }
}
