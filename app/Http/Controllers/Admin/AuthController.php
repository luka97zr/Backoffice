<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
        return response()->json([
            'success' => true,
        ])->withCookie('token', $jwtToken, config('jwt.ttl'), '/', null, false, true);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        if ($request->hasCookie('token')) {
            Cookie::queue(Cookie::forget('token'));
            $request->headers->remove('Authorization');
        }
        return response()->json(['message' => 'Successfully logged out'])->withCookie('token');
    }

    public function getUser() {
        return response()->json(auth()->user());
    }
}
