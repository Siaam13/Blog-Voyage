<?php 

namespace App\Service\Enum;

enum UserRole: string {
    case ADMIN = 'ADMIN';
    case USER = 'USER';
}