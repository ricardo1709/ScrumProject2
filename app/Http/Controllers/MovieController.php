<?php

namespace App\Http\Controllers;

use App\Movie;
use App;
// use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

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
        $results = Movie::where('movieId', $id)->get();
        return view('movie', compact('results'));
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

    public function getData(){
    	$client = new Client();
    	$api_response = $client->get('http://www.omdbapi.com/?i=tt3896198&apikey=11afb677');
    	$response = $api_response->getBody();
    	$movies = json_decode($response);
        return view('movies.index', compact('movies'));
    }
}