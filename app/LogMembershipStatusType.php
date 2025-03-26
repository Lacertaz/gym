<?php

namespace App;

enum LogMembershipStatusType: string
{
    case UNPAID = 'unpaid';
    case PAID = 'paid';
    case REJECT = 'reject';

    public function label(): string
    {
        return match ($this) {
            self::UNPAID => 'Unpaid',
            self::PAID => 'Paid',
            self::REJECT => 'Reject',
        };
    }
}
