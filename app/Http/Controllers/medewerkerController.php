<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class medewerkerController extends Controller
{
    public function index(){
        
        $medewerkers = DB::Table('users')->where('role', 1)->get();
        
        return view('Admin.medewerker', ['medewerkers' => $medewerkers]);
    }
    
    public function store(Request $request){
        
        DB::Table('users')->insert(['name' => $request->name, 'email' => $request->email, 'password' => '$2y$10$fho1aJ5TI2nODVHoKDqzTO0i1Gge06KMVTpiCQnG7YCvfHBUS55pW', 'role' => 1]);
        
        return redirect('/medewerker');
    }
    
    public function delete(Request $request){
        DB::Table('users')->where('id', '=', $request->id)->delete();
        return redirect('/medewerker');
    }
}
