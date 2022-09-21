<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const IS_ADMIN = 'admin';
    const IS_USER = 'user';
    const IS_MANAGER = 'manager';

    public function user() {
        return $this->hasMany(User::class);
    }

    public function rolePermission() {
        return $this->hasMany(RolePermission::class);
    }
}
