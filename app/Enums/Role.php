<?php

namespace App\Enums;

enum Role: string
{
    case Owner = 'owner';
    case User = 'user';
    case SuperAdmin = 'super_admin';

    public static function getRoles(): array
    {
        return [
            self::Owner,
            self::User,
            self::SuperAdmin,
        ];
    }
}
