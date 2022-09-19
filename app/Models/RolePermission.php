<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RolePermission extends Pivot
{
    use HasFactory;

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function permission() {
        return $this->belongsTo(Permission::class);
    }
}
