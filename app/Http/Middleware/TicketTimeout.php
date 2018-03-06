<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class TicketTimeout
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

        $ticket = Ticket::where('ticketId', '=', $request->id)->get()[0];
        
        if($ticket->reserve->movie->planning->time > Carbon::now())
        {
            return $next($request);
        }
        return redirect('/movies');
        
    }
}
