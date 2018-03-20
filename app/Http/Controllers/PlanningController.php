<?php

namespace App\Http\Controllers;

use App\Movie;
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
        $planning = Planning::query()->where("date", '=', \Carbon\Carbon::now()->toDateString())->get();
        return view("planning/index")->with("date", \Carbon\Carbon::now());
    }

    public function create()
    { 
        return view('planning.blade.php');
    }

    /**
     * @param Request $request
     * whit movie id as movie,
     * whit array of seats id as seats;
     * @return mixed
     */

    public function store(Request $request)
    {
        $date = $request->get('date');
        $time = $request->get('time');
        $movie = $request->get('movie');
        $room = $request->get('room');
        
        $movie = Movie::query()->where('movieTitle', '=', $movie)->first(['movieId'])['movieId'];
        Planning::query()->insert(['movieId'=> $movie, 'time'=> $time, 'date' => $date, 'roomId' => $room]);
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