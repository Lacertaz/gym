<?php

namespace App\Models;

use App\LogMembershipStatusType;
use App\MemberType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogMembership extends Model
{
    /** @use HasFactory<\Database\Factories\LogMembershipFactory> */
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'gym_package_id',
        'gym_package_name',
        'price',
        'duration',
        'member_type',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => LogMembershipStatusType::class,
        'member_type' => MemberType::class,
    ];

    // append
    protected $appends = [
        'status_badge',
    ];

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function gymPackage(): BelongsTo
    {
        return $this->belongsTo(GymPackage::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        $statusColors = [
            LogMembershipStatusType::UNPAID->value => 'badge-info',
            LogMembershipStatusType::PAID->value => 'badge-success',
            LogMembershipStatusType::REJECT->value => 'badge-error',
        ];
        $badge_color = $statusColors[$this->status->value] ?? 'badge-warning';

        return '<div class="badge badge-xs '.$badge_color.'">'.$this->status->label().'</div>';
    }
}
