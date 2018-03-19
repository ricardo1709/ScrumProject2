<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
//use App\Product;
//use App\Http\Requests;
use GuzzleHttp\Client;
//use GuzzleHttp\Message\Request;
//use GuzzleHttp\Message\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        // $movies = Movie::orderBy('created_at','desc')->paginate(10);
        $movies = DB::table('movies')
            ->join('plannings', 'movies.movieId', '=', 'plannings.movieId')
            ->select('movies.movieId', 'movieTitle', 'movieDescription', 'roomId', 'time')
            ->orderBy('time', 'asc')
            ->get();

        return view('overview', compact('movies'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $url = 'http://www.omdbapi.com/?i=tt3896198&apikey=11afb677&t=' . $request->get('movieAdd');
        $client = new Client();
        $api_response = $client->get($url);
        $response = $api_response->getBody();
        $movies = json_decode($response);
        DB::table('movies')->insert(
            ['movieTitle' => $movies->Title, 'movieDescription' => $movies->Plot, 'moviePrice' => 0, 'speeltijd' => $movies->Runtime, 'genre' => $movies->Genre]
        );
        return redirect('/admin/movieupdate');
    }

    public function show($id)
    {
    	$loggedIn = Auth::check();
        //$results = Movie::where('movieId', $id)->get();
        $movieInfo = DB::table('movies')->where('movieId', $id)->first();
        $title = $movieInfo->movieTitle;
        $desc = $movieInfo->movieDescription;
        $runtime = $movieInfo->speeltijd;
        $genre = $movieInfo->genre; 
        
        //dd($genre);
        return view('movie', compact('loggedIn', 'title', 'desc', 'runtime', 'genre'));
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

    public function movieAdd(){


        return view('Admin/addMovie');
    }

    public function addMovie(Request $require){
        $url = 'http://www.omdbapi.com/?i=tt3896198&apikey=11afb677&t=' . $require->get('movieAdd');
    	$client = new Client();
    	$api_response = $client->get($url);
    	$response = $api_response->getBody();
    	$movies = json_decode($response);
        DB::table('movies')->insert(
            ['movieTitle' => $movies->Title, 'movieDescription' => $movies->Plot, 'moviePrice' => 0]
        );
    }
}