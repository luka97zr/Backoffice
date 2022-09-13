<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return User::where('id', '!=', auth()->user()->id)->with('role')->paginate(5);
    }

    public function update(UpdateProfileRequest $request, User $user) {
        try {
            User::findOrFail($user->id)->update($request->only(['email', 'name', 'password']));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}
