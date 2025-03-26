<?php

namespace App;

enum RoleType: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case USER = 'user';

    public function label(): string
    {
        return match ($this) {
            static::SUPER_ADMIN => 'Super Admin',
            static::ADMIN => 'Admin',
            static::USER => 'User',
        };
    }

    public function fromValue(string $value): self
    {
        return match ($value) {
            static::SUPER_ADMIN => static::SUPER_ADMIN,
            static::ADMIN => static::ADMIN,
            static::USER => static::USER,
            default => static::USER,
        };
    }
}
