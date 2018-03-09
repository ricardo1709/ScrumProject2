<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
	public function index()
    {
    	$seats = Input::get('sseats');
        $loveseats = Input::get('sloveseats');
        
        $allseats = array();

        $allseats = $seats . $loveseats;

	    if (Auth::user()->role >= 1)
	    {
		    return view();
	    }
	    else {
		    return view('paysuccess', ['allseats' => $allseats
		    ]);
	    }
    }
}