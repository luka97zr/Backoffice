<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\Permission;
use App\Services\GateService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(GateService $gate)
    {
        $this->gate = $gate;
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            User::findOrFail(Auth::user()->id)->update($request->only(['email', 'name', 'password']));
        } catch(\Exception $e) {
            return response( $e->getMessage(), 403);
        }
    }
}
