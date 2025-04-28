<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobilePrefix extends Model
{
    protected $fillable = [
        'prefix',
        'operator',
        'description',
    ];
}
