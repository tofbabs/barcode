<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Barcode;
use Illuminate\Validation\ValidationException;
use Keygen;
use App;
use PDF;
use Mail;

class BarcodeController extends Controller
{
    public function index()
    {


        $data = ['barcode' => 12345];

        $pdf = PDF::loadView('welcome', $data);

        Mail::send('emails.test', $data, function ($message) use ($pdf) {
            $message->from('eko.5samuel@gmail.com', 'Your Name');
            $message->to('eko.5samuel@gmail.com')->subject('Invoice');
            $message->attachData($pdf->output(), "invoice.pdf");
        });
    }

    public function test()
    {
        $barcode = 22345;
        $pdf = PDF::loadView('pdf.ebib', ['barcode' => $barcode])
            ->setPaper('a5', 'landscape')
            ->save(storage_path('app/public/pdf/' . $barcode . '.pdf'));
        return $pdf->stream('invoice.pdf');
    }

    public function show()
    {
        try {
            $rule = $this->getRule();
            request()->validate($rule);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
                'message' => $e->getMessage()
            ], 422);
        }

        $email = request()->email;
        $name = request()->name;



        try {

            if (Barcode::whereEmail($email)->exists()) {
                    $barcodes = Barcode::whereEmail($email)->first();
                    $barcode = $barcodes->ebib;
                    $email = $barcodes->email;
                    if (request()->isRequestEmail === 1) {
                        $this->sendUserEbibPDF($email, $barcode, $name);
                        $this->sendAdminEbibPDF($email, $barcode);
                    }
                } else {
                $ebib = $this->generateID();
                $barcode = 'app/public/pdf/'.$ebib.'.pdf';

                $data = compact("email", "ebib", $barcode);

                if ($barcodes = Barcode::create($data)) {
                    $barcode = $barcodes->ebib;

                    // Stores barcode to PDF 
                    $this->storePDF($barcode);

                    $this->sendUserEbibPDF($email, $barcode, $name);
                    $this->sendAdminEbibPDF($email, $barcode);

                }
            }

            $pdf = PDF::loadView('pdf.ebib', ['barcode' => $barcode])
                ->setPaper('a5', 'landscape');

            return $pdf->download('ebip.pdf');

        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ], 403);
        }
    }

    public function sendUserEbibPDF($email, $barcode, $name)
    {
        $data = ['barcode' => $barcode, 'name' => $name];
        $pdf = PDF::loadView('pdf.ebib', $data)
            ->setPaper('a5', 'landscape');

        $subject = "Hello $name, your BIB Number for the Access Bank Lagos City Marathon 2020 is $barcode";

        Mail::send('emails.user', $data, function ($message) use ($pdf, $email, $subject) {

            $from = Config::get('constants.emailSetup.user');

            $message->from($from, 'Access Bank Lagos Marathon');
            $message->to($email)->subject($subject);
            $message->attachData($pdf->output(), "marathon.pdf");
        });
    }

    public function sendAdminEbibPDF($email, $barcode)
    {
        $data = ['barcode' => $barcode, 'bars' => $email];
        $pdf = PDF::loadView('pdf.ebib', $data)
            ->setPaper('a5', 'landscape');

        Mail::send('emails.admin', $data, function ($message) use ($pdf, $email) {
            $from = Config::get('constants.emailSetup.user');
            $message->from($from, 'Access Bank Lagos Marathon');
            $message->to("tech@tm30.net")->subject('Lagos Marathon');
            $message->attachData($pdf->output(), "marathon.pdf");
        });
    }

    protected function generateNumericKey()
    {
        // prefixes the key with a random integer between 1 - 9 (inclusive)
        return Keygen::numeric(4)
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

    public function invoice()
    {
        //        return view('invoice.test');
        $pdf = PDF::loadView('invoice.test')
            ->setPaper('a4');
        return $pdf->stream('invoice.pdf');
    }

    public function storePDF($barcode)
    {
        return PDF::loadView('pdf.ebib', ['barcode' => $barcode])
            ->setPaper('a5', 'landscape')
            ->save(storage_path('app/public/pdf/' . $barcode . '.pdf'));
    }

    public function getRule()
    {
        return [
            'email' => 'required|email',
            'name' => 'required',
            'isRequestEmail' => 'required|boolean'
        ];
    }
}
