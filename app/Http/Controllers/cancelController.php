<?php

namespace App\Http\Controllers;

use App\Mail\cancel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    public function index(){
        Mail::to('d257367@edu.rocwb.nl')->send(new cancel());
    }
}
