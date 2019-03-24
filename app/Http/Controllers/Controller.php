<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function emailBibToUser($to, $from, $subject, $data, $view){
        Mail::to($to)->queue(new SendMail($to, $from, $subject, $data, $view));
    }

    public function emailBibToAdmin($to, $from, $subject, $data, $view){
        Mail::to($to)->queue(new SendMail($to, $from, $subject, $data, $view));
    }
}
