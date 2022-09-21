<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// enum Special:string {
//     case CAN_EDIT = 'edit';
//     case CAN_DELETE =  'delete';
//     case CAN_VIEW = 'view';
//     case CAN_CREATE = 'create';

//     case CAN_CREATE_USER = 'create_user';
//     case CAN_EDIT_USER = 'edit_user';
//     case CAN_DELETE_USER = 'delete_user';
//     case CAN_VIEW_USER = 'view_user';
// }

class Permission extends Model
{
    use HasFactory;

    const CAN_CREATE_USER = 'create_user';
    const CAN_EDIT_USER = 'edit_user';
    const CAN_DELETE_USER = 'delete_user';
    const CAN_VIEW_USER = 'view_user';

    const CAN_EDIT = 'edit';
    const CAN_DELETE =  'delete';
    const CAN_VIEW = 'view';
    const CAN_CREATE = 'create';

    public function rolePermission() {
        return $this->hasMany(RolePermission::class);
    }
}
