<?php

namespace App\Models;

use App\MemberType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GymPackage extends Model
{
    /** @use HasFactory<\Database\Factories\GymPackageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'duration',
        'member_type',
    ];

    protected $casts = [
        'member_type' => MemberType::class,
    ];

    public function logMembership(): HasMany
    {
        return $this->hasMany(LogMembership::class);
    }
}
