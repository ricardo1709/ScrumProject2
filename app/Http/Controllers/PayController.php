<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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