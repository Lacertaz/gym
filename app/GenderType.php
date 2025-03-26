<?php

namespace App;

enum GenderType: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    public function label(): string
    {
        return match ($this) {
            static::MALE => 'Laki-laki',
            static::FEMALE => 'Perempuan',
        };
    }
}
