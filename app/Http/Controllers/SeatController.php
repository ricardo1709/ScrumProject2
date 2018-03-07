<?php

namespace App\Http\Controllers;

use App\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Seat $seat)
    {
        //
    }

    public function edit(Seat $seat)
    {
        //
    }

    public function update(Request $request, Seat $seat)
    {
        //
    }

    public function destroy(Seat $seat)
    {
        //
    }

    public function GenerateRandomSeat($totalSeats, $currentSeat)
    {
    	do {
		    $newSeat = rand(0, $totalSeats);
	    } while($newSeat == $currentSeat);

    	return $newSeat;
    }

}
