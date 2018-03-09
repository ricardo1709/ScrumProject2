<?php

namespace App\Http\Middleware;

use App\Ticket;
use Closure;
use Illuminate\Support\Facades\Auth;

class Collaborator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 1)
    {
        try
        {
            if (Auth::user()->role >= $role)
            {
                return $next($request);
            }
            else
            {
                return redirect()->back();
            }
        }
        catch(\Exception $e)
        {
            return redirect()->back();
        }

    }
}
