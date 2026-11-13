<?php

namespace App\Services;

use App\Models\SubscriptionPayment;
use App\Models\User;
use Carbon\Carbon;

class SubscriptionService
{
    public function activeSubscription(User $user): ?SubscriptionPayment
    {
        return $user->verifiedSubscriptionPayments()
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', now())
            ->latest('expires_at')
            ->first();
    }

    public function isActive(User $user): bool
    {
        return $this->activeSubscription($user) !== null;
    }

    public function expirationDate(User $user): ?Carbon
    {
        return $this->activeSubscription($user)?->expires_at;
    }

    public function nextSubscriptionPeriod(User $user): array
    {
        $latestSubscription = $user->verifiedSubscriptionPayments()
            ->whereNotNull('expires_at')
            ->latest('expires_at')
            ->first();

        $now = now();

        $start = $latestSubscription && $latestSubscription->expires_at->greaterThan($now)
            ? $latestSubscription->expires_at->copy()
            : $now->copy();

        $end = $start->copy()->addMonthNoOverflow();

        return [
            'starts_at' => $start,
            'expires_at' => $end,
        ];
    }
}
