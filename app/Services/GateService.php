<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Auth;

class GateService {
    protected array $permissionsArray;

    public function __construct()
    {
        if(!auth()->check()) return;
        $this->permissionsArray = Auth::user()->role->rolePermission->pluck('permission.slug')->all();
    }

    public function isAllowed($permission)
    {
        return (in_array( $permission, $this->permissionsArray )) ? true : throw new Exception('You are not authorized');
    }
}