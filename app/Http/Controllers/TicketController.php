<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class TicketController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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

    	// Makes a new domPDF instance
		$pdf = App::make('dompdf.wrapper');

		// Loads HTML into generator, can also use file reference to convert.
		// Can also use view('view reference');
		$pdf->loadHTML($this->createBarcode("0123456789"));

		// Returns PDF
		return $pdf->stream();
	}

	// Gets Barcode value parsed
	public function createBarcode($barcode)
	{
		// Generates barcode img
		$imgBarcode = \DNS1D::getBarcodePNG($barcode, "C39");

		// Returns the template view, with imgBarcode and original barcode value
    	return view('TicketPDF.pdftemplate', compact('imgBarcode', 'barcode'));
	}
}
