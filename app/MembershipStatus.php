<?php

namespace App;

enum MembershipStatus: string
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case NEW = 'new';

    public function label()
    {
        return match ($this) {
            MembershipStatus::ACTIVE => 'Aktif',
            MembershipStatus::EXPIRED => 'Expired',
            MembershipStatus::NEW => 'Baru',
        };
    }
}
