<?php

namespace App;

enum MemberType: string
{
    case PENGHUNI = 'penghuni';
    case NON_PENGHUNI = 'non_penghuni';

    public function label(): string
    {
        return match ($this) {
            static::PENGHUNI => 'Penghuni',
            static::NON_PENGHUNI => 'Non Penghuni',
        };
    }
}
