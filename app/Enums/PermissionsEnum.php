<?php

namespace App\Enums;

enum PermissionsEnum:string {
    case CAN_EDIT = 'edit';
    case CAN_DELETE =  'delete';
    case CAN_SEE = 'see';
}