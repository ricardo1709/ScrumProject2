<?php

namespace App\Http\Middleware;

use App\Ticket;
use Closure;
use Illuminate\Support\Facades\Auth;

class TicketOwner
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
        $ticket = Ticket::where('ticketId', '=', $request->id)->get();

        if (count($ticket) == 1 && $ticket[0]->reserve->
            user->id === Auth::user()->id)
        {
            return $next($request);
        }
        return redirect('/movies');

    }
}
