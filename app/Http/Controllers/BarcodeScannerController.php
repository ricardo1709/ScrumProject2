<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BarcodeScannerController extends Controller
{
    public function index(){
        return view('barcodes.index');
    }
    
    
    public function check(Request $request){
        
        $barcode = $request->barcode;
        $length = strlen($barcode);
        
        if($length == 10){
            
            $dbBarcode = DB::table('barcode_scanners')->where('barcode', $barcode)->first();
            $dbReservation = DB::table('reserves')->where('ticketId', $dbBarcode->id)->first();
            $dbPlanning = DB::table('plannings')->where('planningId', $dbReservation->transactionId)->first();
            
            
            if($dbBarcode == true){
                if($dbBarcode->checked == 0){
                    
                    
                    DB::table('barcode_scanners')->where('id', $dbBarcode->id)->update(['checked' => 1]);
                    return view('barcodes.correct', ['barcode' => $barcode, 'seat' => $dbReservation->seatId, 'room' => $dbPlanning->roomId]);
                }
                
                else{
                    return view('barcodes.incorrect', ['error' => "Code al gebruikt"]);
                }
            }
            
            else{
                return view('barcodes.incorrect', ['error' => "Code niet gevonden"]);
            }
        }
        
        else{
            return view('barcodes.incorrect', ['error' => "Code te kort"]);
        }
    }
}
