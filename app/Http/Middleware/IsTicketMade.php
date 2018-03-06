<?php

namespace App\Http\Middleware;

use Closure;

class IsTicketMade
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $barcode = Ticket::table('tickets')->get();
        return $next($request);
    }
}
