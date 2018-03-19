<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planning;
use App\Movie;
class planningController extends Controller
{
    
    public function index()
    {
        $planning = Planning::query()->where("time", '=', \Carbon\Carbon::now()->toDateTimeString())->get();
        return view("planning/index")->with("date", \Carbon\Carbon::now());
    }
    
    public function create()
    {
        
    }
    
    public function store(Request $request)
    {
        $date = $request->get('date');
        $time = $request->get('time');
        $movie = $request->get('movie');
        $room = $request->get('room');
        
        $movie = Movie::query()->where('movieTitle', '=', $movie)->first(['movieId'])['movieId'];
        Planning::query()->insert(['movieId'=> $movie, 'time'=> $time, 'date' => $date, 'roomId' => $room]);
    }
}
