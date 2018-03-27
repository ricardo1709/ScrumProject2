<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\View\View;
use Illuminate\Support\Facades\View;

class PayController extends Controller
{
	public function store(Request $request)
    {
		$s = $request->input('sseats');
		$ls = $request->input('sloveseats');
        
        $allseats = array();

        if (!empty($s) && !empty($ls)) {
        	$allseats = array_merge($s, $ls);
        } elseif (!empty($s) && empty($ls)) {
        	$allseats = $s;
        } elseif (empty($s) && !empty($ls)) {
        	$allseats = $ls;
        }

	    if (Auth::user()->role >= 1)
	    {
			return View::make('paysuccessemployee', array('allseats' => $allseats));
	    }
	    else {
		    return View::make('paysuccess', array('allseats' => $allseats));
	    }
    }
	
	public function complete()
	{
		return view('paysuccess', ['allseats' => $request->input('allseats')]);
	}
	
	public function completeemployee() 
	{
		return view('paysuccessemployee', ['allseats' => $request->input('allseats')]);
	}
}