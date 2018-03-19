<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Milon\Barcode\DNS1D;
use App\Seat;
use App\Reserve;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        //
    }

    public function create($allseatids)
    { 
        $tickets = array();

        $user = Auth::user();
          
        foreach($allseatids as $id)
        {
            array_push($tickets, new Ticket);
        }

        return redirect('/movies');

    }

    /**
     * @param Request $request
     * whit movie id as movie,
     * whit array of seats id as seats;
     * @return mixed
     */

    public function store(Request $request)
    {
        $totalloveseat = 0;
        $totalseatprice = 0;

        $user = Auth::user();
        $movie = $request->get('movie');
        $seats = $request->get('seats', []); 
        $loveseatmultiplier = DB::table('globalvars')->where('keyname', 'loveseat')->value('value');
        $seatprice = DB::table('globalvars')->where('keyname', 'seat')->value('value');

        foreach($seats as $seatid)
        {
            $isloveseat = DB::table('seats')->where('seatId', $seatid)->value('isLoveseat');
 
            if($isloveseat == 1)
            {
                $totalloveseat += $seatprice * $loveseatmultiplier;
            }
            else
            {
                $totalseatprice += $seatprice;
            }
        }

        $totalprice = $totalloveseat + $totalseatprice;
        
        
        

        //$seats = [3,4];
        //$movie = 1;


        

        $transaction = \App\Transaction::query()->insertGetId(
          [ 'userId' => $user->id, 'movieId' => $movie, 'payedAmount' => $totalprice]
        );

        foreach ($seats as $seat)
        {
            Seat::query()->where('seatId')->first()->reserve(true);
            
            $ticket = \App\Ticket::query()->insertGetId(
                [ 'seatId' => $seat, 'movieId' => $movie,
                  'transactionId' => $transaction, 'barcode' => "123456789"]
            );

            \App\Reserve::query()->insert(
                [ 'seatId' => $seat, 'movieId' => $movie,
                    'transactionId' => $transaction, 'ticketId' => $ticket,
                    'userId' => $user->id]
            );
        }

        Mail::to($user)->send(new \App\Mail\Ticket($transaction));

        return redirect()->back();
    }

    /**
     * @param $id
     * @return mixed
     *
     */
    public function show($id)
    {
        $ticket = Ticket::where('ticketId', '=', $id)->get()[0];

        // Makes a new domPDF instance
        //$pdf = \App::make('dompdf.wrapper');
        $pdf = new Dompdf();

        // Loads HTML into generator, can also use file reference to convert.
        // Can also use view('view reference');


        $pdf->loadHTML($this->loadPDFtemplate("0123456789", $ticket));

        // Returns PDF
        return $pdf->stream();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $ticket = Ticket::query()->where('ticketId', '=', $id)->first();
        Seat::query()->where('seatId', '=', $ticket->seatId)->first()->reserve(false);
        Reserve::query()->where('ticketId', '=', $id)->delete();
        $ticket->delete();
    }

    // This method generates a PDF from an html template
	// This method requires domPDF to function properly
	// Add use App; if it not exists on the top of the file.
	// To get domPDF:
	//      composer require dompdf/dompdf
    /**
     * @deprecated will be removed later
     * @since 0.1v2s
     * @example code for PDF
     * @return mixed
     * @uses dompdf/dompdf, milon/barcode
     */
	public function createPDF()
	{
        //$pdf = \App::make('dompdf.wrapper');
	    $pdf = new Dompdf();
        // Loads HTML into generator, can also use file reference to convert.
        $pdf->loadHTML($this->loadPDFtemplate("9592954","959292"));

        // Returns PDF
        return $pdf->stream();
	}

	// Loads view and loads barcode
	public function loadPDFtemplate($barcode, $ticket)
	{
		$imgBarcode = $this->createBarcode($barcode);

		return view('TicketPDF.pdftemplate', compact('imgBarcode', 'barcode'))->with('ticket', $ticket)->with('movie', $ticket->reserve->movie)
            ->with('room', $ticket->seat->room)->with('planning', $ticket->reserve->movie->planning);
	}

	// Use 'composer require milon/barcode' to obtain barcode generator
	// Gets Barcode value parsed
	public function createBarcode($barcode)
	{
		// Generates barcode img
		$imgBarcode = DNS1D::getBarcodePNG($barcode, "C39");

		// Returns the template view, with imgBarcode and original barcode value
    	return $imgBarcode;
	}


}

