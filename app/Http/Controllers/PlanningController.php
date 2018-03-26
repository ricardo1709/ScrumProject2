<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Room;
use App\Planning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanningController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $date = ['day' => date('d'), 'month' => date('m'), 'year' => date('y')];

        $rooms = Room::get();

        $movies = Movie::get();

        return view("planning/index", compact("date", "rooms", "movies"));
    }

    public function create()
    { 
        return view('planning');
    }

    /**
     * @param Request $request
     * whit movie id as movie,
     * whit array of seats id as seats;
     * @return mixed
     */

    public function store(Request $request)
    {
        $time = $request->get('time');
        $movie = $request->get('movie');
        $room = $request->get('room');
        
        //$movie = Movie::query()->where('movieTitle', '=', $movie)->first(['movieId'])['movieId'];
        Planning::query()->insert(['movieId'=> $movie, 'time'=> $time, 'roomId' => $room]);
        return redirect('/movies');
    }

    /**
     * @param $id
     * @return mixed
     *
     */
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}