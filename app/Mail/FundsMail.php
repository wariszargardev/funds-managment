<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FundsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fund = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fund)
    {
        $this->fund = $fund;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.funds');
    }
}
