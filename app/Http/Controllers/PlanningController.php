<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        //
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