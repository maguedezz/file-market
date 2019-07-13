<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfMarketplaceNotConnected
{

    public function handle($request, Closure $next)
    {
        if (!auth()->user()->stripe_id) {
            return redirect()->route('account.connect');
        }
        return $next($request);
    }
}
