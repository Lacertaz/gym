<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoGym extends Model
{
    /** @use HasFactory<\Database\Factories\InfoGymFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    protected $appends = [
        'description_br',
    ];

    public function getDescriptionBrAttribute()
    {
        return nl2br($this->description);
    }
}
