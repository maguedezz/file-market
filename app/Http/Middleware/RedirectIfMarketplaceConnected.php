<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfMarketplaceConnected
{
 
    public function handle($request, Closure $next)
    {

        if (auth()->user()->stripe_id) {
            return redirect()->route('account');
        }

        return $next($request);
    }
}
