<?php

namespace App\Http\Controllers;

use App\Movie;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('created_at','desc')->paginate(10);
        return view('overview', compact('movies'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
    	$loggedIn = Auth::check();
        $results = Movie::where('movieId', $id)->get();
        return view('movie', compact('results', 'loggedIn'));
    }

    function edit($id)
    {
        $movie = Movie::where('movieId', $id)->get();

        return view('overview')->with('movies', $movie);
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