<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class changeGlobalsController extends Controller
{
    public function index()
    {
        $seatPrice = DB::table('globalvars')->where('keyname', 'seat')->first();
        
        return view('Admin.price', ['currentPrice' => $seatPrice->value]);
    }
    
    public function store(Request $request){
        $newPrice = $request->new_price;
        
        DB::table('globalvars')->where('keyname', 'seat')->update(['value' => $newPrice]);
        
        return redirect('/price');   
    }
}
