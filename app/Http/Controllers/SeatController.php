<?php

namespace App\Http\Controllers;

use App\Seat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    public function show($id) 
    {
        $theroomid = DB::table('plannings')->where('movieId', $id)->pluck('roomId');

        $rooms = DB::table('rooms')->where('roomId', $theroomid)->get();
        
        $seatStrings = array();
        $loveSeatStrings = array();

        $seatArray = array();
        $loveSeatArray = array();

        foreach ($rooms as $rm) {
            $seatStrings[$rm->roomId] = "repeat(" . ($rm->seats / $rm->rows) . ", 1fr);";
            $loveSeatStrings[$rm->roomId] = "repeat(" . ($rm->loverSeats / $rm->loverRow) . ", 1fr);";
            
            $seatArray[($rm->roomId)] = DB::table('seats')->where('roomId', ($rm->roomId))->where('isLoveseat', 0)->get()->toArray();

            $loveSeatArray[($rm->roomId)] = DB::table('seats')->where('roomId', ($rm->roomId))->where('isLoveseat', 1)->get()->toArray();
        }

        return view('order', ['rooms' => $rooms, 'seatStrings' => $seatStrings, 'loveSeatStrings' => $loveSeatStrings, 'seatArray' => $seatArray, 'loveSeatArray' => $loveSeatArray]);

        //return $seatArray;
    }    

	public function showAll()
    {
    	$rooms = DB::table('rooms')->get();
        
        $seatStrings = array();
        $loveSeatStrings = array();

        $seatArray = array();
        $loveSeatArray = array();

        foreach ($rooms as $rm) {
            $seatStrings[$rm->roomId] = "repeat(" . ($rm->seats / $rm->rows) . ", 1fr);";
            $loveSeatStrings[$rm->roomId] = "repeat(" . ($rm->loverSeats / $rm->loverRow) . ", 1fr);";
            
            $seatArray[($rm->roomId)] = DB::table('seats')->where('roomId', ($rm->roomId))->where('isLoveseat', 0)->get()->toArray();

            $loveSeatArray[($rm->roomId)] = DB::table('seats')->where('roomId', ($rm->roomId))->where('isLoveseat', 1)->get()->toArray();
        }

        return view('orderEmployee', ['rooms' => $rooms, 'seatStrings' => $seatStrings, 'loveSeatStrings' => $loveSeatStrings, 'seatArray' => $seatArray, 'loveSeatArray' => $loveSeatArray]);

        //return $seatArray;
    }


    public function GenerateRandomSeat($totalSeats, $currentSeat)
    {
    	do {
		    $newSeat = rand(0, $totalSeats);
	    } while($newSeat == $currentSeat);

    	return $newSeat;
    }

}