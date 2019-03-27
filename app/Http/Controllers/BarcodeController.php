<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Barcode;
use Keygen;
use App;
use PDF;
use Mail;

class BarcodeController extends Controller
{
	public function index() {
		

		$data = ['barcode' => 12345];

		$pdf = PDF::loadView('welcome', $data);

		Mail::send('emails.test', $data, function($message) use($pdf)
		{
		    $message->from('eko.5samuel@gmail.com', 'Your Name');

		    $message->to('eko.5samuel@gmail.com')->subject('Invoice');

		    $message->attachData($pdf->output(), "invoice.pdf");
		});


	}

	public function test()
	{
		$pdf = PDF::loadView('welcome', ['barcode' => 12345]);
		return $pdf->stream('invoice.pdf');	
	}

    public function show($userId, $email)
    {
    	if(Barcode::whereEmail($email)->exists())
    	{
    		$barcodes = Barcode::whereEmail($email)->first();
    		//return 
    		$barcode = $barcodes->ebib;

    		$data = $barcode;
			$to = $email;
		    $from = Config::get('constants.emailSetup.user');
		    $subject = 'Your marathon barcode is';
			$this->emailBibToUser($to, $from, $subject, $data, 'emails.barcode');
			$this->emailBibToAdmin($from, $from, $subject, $data, 'emails.barcode');
    		return response()->json([
    				'data' => $barcodes,
    			], 200);
    	} else {
    		$ebib = $this->generateID();
    		$data['email'] = $email;
    		$data['user_id'] = $userId;
    		$data['ebib'] = $ebib;
    		$data['barcode'] = $ebib;
    		if($barcodes = Barcode::create($data)){
    			// return here 
    			$data = $ebib;
    			$to = $email;
			    $from = Config::get('constants.emailSetup.user');
			    $subject = 'Your marathon barcode is';
    			$this->emailBibToUser($to, $from, $subject, $data, 'emails.barcode');
    			$this->emailBibToAdmin($from, $from, $subject, $data, 'emails.barcode');
    			return response()->json([
    				'data' => $barcodes,
    			], 200);
    		}
    	}
    }

	protected function generateNumericKey()
	{
	    // prefixes the key with a random integer between 1 - 9 (inclusive)
	    return Keygen::numeric(5)
	    ->prefix(mt_rand(1, 9))
	    ->generate(true);
	}
	
	 // generateID() method

	protected function generateID()
	{
	    $ebib = $this->generateNumericKey();

	    // Ensure ID does not exist
	    // Generate new one if ID already exists
	    while (Barcode::whereEbib($ebib)->count() > 0) {
	        $ebib = $this->generateNumericKey();
	    }

	    return $ebib;
	}

	public function generateBib($ebib)
	{
		return view('barcode')->with('barcode', $ebib);
	}
}
