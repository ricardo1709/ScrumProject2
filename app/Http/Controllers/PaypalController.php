<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    protected $provider;
	public function __construct() {
    	$this->provider = new ExpressCheckout();
	}
	public function expressCheckout($mvid, $plid) {
	      
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

        $transaction = \App\Transaction::query()->insertGetId(
          [ 'userId' => $user->id, 'movieId' => $movie, 'payedAmount' => $totalprice, 'payment_status' => 'false']
        );

	  // send a request to paypal 
	  // paypal should respond with an array of data
	  // the array should contain a link to paypal's payment system
	  $response = $this->provider->setExpressCheckout($totalprice);

	  // if there is no link redirect back with error message
	  if (!$response['paypal_link']) {
	    return redirect('/')->with(['code' => 'danger', 'message' => 'iets ging mis met paypal']);
	    // For the actual error message dump out $response and see what's in there
	  }

	  // redirect to paypal
	  // after payment is done paypal
	  // will redirect us back to $this->expressCheckoutSuccess
      'return_url' -> url('/paypal/express-checkout-success');
	  return redirect($response['paypal_link']);
  }

    public function expressCheckoutSuccess() {

        // initaly we paypal redirects us back with a token
        // but doesn't provice us any additional data
        // so we use getExpressCheckoutDetails($token)
        // to get the payment details
        $response = $this->provider->getExpressCheckoutDetails($token);

        // if response ACK value is not SUCCESS or SUCCESSWITHWARNING
        // we return back with error
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect('/')->with(['code' => 'danger', 'message' => 'Fout bij verwerken van paypal']);
        }

        // App\Invoice has a paid attribute that returns true or false based on payment status
        // so if paid is false return with error, else return with success message
        if ($invoice->paid) {
            return redirect('/')->with(['code' => 'success', 'message' => 'Order ' . $invoice->id . ' has been paid successfully!']);
        }
        
        return redirect('/')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment for Order ' . $invoice->id . '!']);
    }

    public function notify(Request $request)
    {

        // add _notify-validate cmd to request,
        // we need that to validate with PayPal that it was realy
        // PayPal who sent the request
        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();

        // send the data to PayPal for validation
        $response = (string) $this->provider->verifyIPN($post);

        //if PayPal responds with VERIFIED we are good to go
        if ($response === 'VERIFIED') {

            /**
                This is the part of the code where you can process recurring payments as you like
                in this case we will be checking for recurring_payment that was completed
                if we find that data we create new invoice
            */
            if ($post['txn_type'] == 'recurring_payment' && $post['payment_status'] == 'Completed') {
                $invoice = new Invoice();
                $invoice->title = 'Recurring payment';
                $invoice->price = $post['amount'];
                $invoice->payment_status = 'Completed';
                $invoice->recurring_id = $post['recurring_payment_id'];
                $invoice->save();
            }

            // I leave this code here so you can log IPN data if you want
            // PayPal provides a lot of IPN data that you should save in real world scenarios
            /*                      
                $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
                Storage::disk('local')->put($logFile, print_r($post, true));
            */
            
        }  
        
    }

}

