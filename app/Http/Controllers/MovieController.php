<?php

namespace App\Http\Controllers;

use App\Movie;
use App;
use Illuminate\Http\Request as Http_Request;
use App\Product;
use App\Http\Requests;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
	public function index()
	{
		// This if statement checks if a genre has been selected and also checks if a radiobutton has been selected
		// so that when the page refreshes the radiobutton doesn't get unchecked
		if(!empty($_GET['genre'])) {
			$movies = Movie::where('genre', $_GET['genre'])
			               ->orWhere('genre', 'like', '%' . $_GET['genre'] . '%')->get();
			$radioSelected = $_GET['genre'];
		} else {
			$movies = Movie::get();
			$radioSelected = "All";
		}

		$movieGenres = $this->getGenres();

		return view('overview', compact('movies','movieGenres', 'radioSelected'));
	}


	public function getGenres()
	{

		$movieGenres = [];

		$finishGenres = [];

		$movies = Movie::get();

		// Generates an array with movie genres
		foreach($movies as $movie) {
			if(!in_array($movie->genre, $movieGenres)){
				$movieGenres[] = $movie->genre;
			}
		}

		// Seperates genres that are in one string but contain a comma.
		foreach($movieGenres as $movieGenre) {
			$newGenres = explode(',', $movieGenre);
			foreach($newGenres as $genre) {
				$cleanGenres[] = str_replace(' ','',$genre);

			}
		}

		// Clears incorrect $movieGenres array
		unset($movieGenres);
		// Fills $movieGenres with correct data
		$movieGenres = $cleanGenres;


		// Removes double genres from array
		foreach($movieGenres as $movieGenre) {
			if(!in_array($movieGenre, $finishGenres)){
				$finishGenres[] = $movieGenre;

			}
		}

		// Clears incorrect $movieGenres array
		unset($movieGenres);
		// Fills $movieGenres with correct data
		$movieGenres = $finishGenres;

		sort($movieGenres);

		return $movieGenres;
	}


	public function create()
    {
        
    }

    public function store(Http_Request $request)
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

    public function addMovie($require){
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