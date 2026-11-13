<?php

namespace App\Http\Middleware;

use App\Services\SubscriptionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isBusinessAdmin()) {
            return $next($request);
        }

        $subscriptionService = app(SubscriptionService::class);

        if ($subscriptionService->isActive($user)) {
            return $next($request);
        }

        return redirect()->route('subscription.renewal');
    }
}
