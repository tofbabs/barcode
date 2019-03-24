<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $eto;
    public $efrom;
    public $esubject;
    public $eview;
    public function __construct($eto, $efrom, $esubject, $data, $eview)
    {
        $this->eto = $eto;
        $this->efrom = $efrom;
        $this->esubject = $esubject;
        $this->data = $data;
        $this->eview = $eview;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->efrom,'Lagos Marathon')
            ->subject($this->esubject)->replyTo($this->eto)->view($this->eview);
    }
}
