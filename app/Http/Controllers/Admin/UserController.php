<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Permission;
use App\Models\User;
use App\Services\GateService;

class UserController extends Controller
{
    public function __construct(GateService $gate)
    {
        $this->gate = $gate;
    }

    public function index()
    {
        return User::where('id', '!=', auth()->user()->id)->with('role')->paginate(5);
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        try {
            $this->gate->isAllowed(Permission::CAN_EDIT_USER);
            User::findOrFail($user->id)->update($request->only(['email', 'name', 'password']));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(User $user)
    {
        try {
            $this->gate->isAllowed(Permission::CAN_DELETE_USER);
            User::destroy($user->id);
        } catch(\Exception $e) {
            return response( $e->getMessage(), 403);
        }
    }
}
