<?php

namespace App\Console\Commands;

use App\MembershipStatus;
use App\Models\Membership;
use Illuminate\Console\Command;

class CheckExpiredMemberships extends Command
{
    protected $signature = 'gym:expired';

    protected $description = 'Check and update expired memberships';

    public function handle()
    {
        $this->info('Starting to check expired memberships');

        $expiredMemberships = Membership::where('expired_date', '<=', now())
            ->where('status', '!=', MembershipStatus::EXPIRED->value)
            ->get();

        $this->info($expiredMemberships->count().' expired memberships found');

        if ($expiredMemberships->isEmpty()) {
            $this->info('No expired memberships found');

            return;
        }

        foreach ($expiredMemberships as $membership) {
            $this->info('Updating membership '.$membership->user->name.' to expired');
            $membership->update([
                'status' => MembershipStatus::EXPIRED->value,
            ]);
        }

        $this->info('Finished checking expired memberships');
    }
}
