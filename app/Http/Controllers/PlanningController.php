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

        $schedule = $this->getPlanned();

        return view("planning/index", compact("date", "rooms", "movies", "schedule"));
    }

    public function generatePlanningDates()
    {
        $date = ['day' => date('d'), 'month' => date('m'), 'year' => date('y')];

        $commmingDates = [];

        for($i = 0; $i < 14; $i++)
        {
            $commingDates[] = "20" . $date['year'] . "-" . $date['month'] . "-" . $date['day'];
            if($date['day'] > 30){
                $date['month']++;
                $date['day'] = 1;
            } else {
                $date['day']++;
            }
        }

        return $this->generatePlanningTimes($commingDates);
    }

    public function generatePlanningTimes($dates)
    {
        foreach($dates as $date)
        {
            $newDate = [$date . ' 15:00:00', $date . ' 18:00:00', $date . ' 20:30:00', $date . ' 22:30:00'];
            $newDates[] = $newDate;
        }

        return $newDates;
    }

    public function getPlanned()
    {
        $timesArray = $this->generatePlanningDates();

        $currentPlanning = Planning::get();

        $schedule[] = "0000-00-00 00:00:00";

        foreach($currentPlanning as $plannedMovie) {
            $schedule[] = $plannedMovie->time;
        }

        foreach($timesArray as $timeArray)
        {
            foreach($timeArray as $time)
            {
                if(!in_array($time, $schedule))
                {
                   $planning[] = $time;
                }
            }
        }

        return $planning;

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
        return redirect('/admin/planning');
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