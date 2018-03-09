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

        //medewerker if statement hier de dan een andere view laat zien!
        return view('paysuccess', ['allseats' => $allseats
    ]);
    }
}