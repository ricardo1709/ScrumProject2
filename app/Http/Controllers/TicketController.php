<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('made.ticket')->only('show');
    }

    public function index()
    {
        $hi = 'Hello';
        return view('ticket', compact('hi'));
    }

    public function create()
    {
        $user = Auth::user();
//        $movie = $request->get('movie');
//        $seats = $request->get('seats');
        $seats = [3,4];
        $movie = 1;
        var_dump($seats);

        $transaction = \App\Transaction::query()->insertGetId(
            [ 'userId' => $user->id, 'movieId' => $movie, 'payedAmount' => 10.00]
        );

        foreach ($seats as $seat)
        {
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

        return redirect('/movies');
    }

    /**
     * @param Request $request
     * whit movie id as movie,
     * whit array of seats id as seats;
     */

    public function store(Request $request)
    {
        $user = Auth::user()->id;
//        $movie = $request->get('movie');
//        $seats = $request->get('seats');
        $seats = [3,4];
        $movie = 1;
        var_dump($seats);

        $transaction = \App\Transaction::query()->insertGetId(
          [ 'userId' => $user, 'movieId' => $movie, 'payedAmount' => 10.00]
        );

        foreach ($seats as $seat)
        {
            $ticket = \App\Ticket::query()->insertGetId(
                [ 'seatId' => $seat, 'movieId' => $movie,
                  'transactionId' => $transaction, 'barcode' => "123456789"]
            );

            \App\Reserve::query()->insert(
                [ 'seatId' => $seat, 'movieId' => $movie,
                    'transactionId' => $transaction, 'ticketId' => $ticket]
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
        $pdf = \App::make('dompdf.wrapper');

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
        //
    }

    // This method generates a PDF from an html template
	// This method requires domPDF to function properly
	// Add use App; if it not exists on the top of the file.
	// To get domPDF:
	//      composer require dompdf/dompdf
	public function createPDF()
	{
        $pdf = \App::make('dompdf.wrapper');

        // Loads HTML into generator, can also use file reference to convert.
        $pdf->loadHTML($this->loadPDFtemplate("9592954","959292"));

        // Returns PDF
        return $pdf->stream();
	}

	// Loads view and loads barcode
	public function loadPDFtemplate($barcode, $ticket)
	{
		$imgBarcode = $this->createBarcode($barcode);

		return view('TicketPDF.pdftemplate', compact('imgBarcode', 'barcode'));
	}

	// Use 'composer require milon/barcode' to obtain barcode generator
	// Gets Barcode value parsed
	public function createBarcode($barcode)
	{
		// Generates barcode img
		$imgBarcode = \DNS1D::getBarcodePNG($barcode, "C39");

		// Returns the template view, with imgBarcode and original barcode value
    	return $imgBarcode;
	}


}

