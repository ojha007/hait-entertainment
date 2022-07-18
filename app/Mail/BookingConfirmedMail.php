<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BookingConfirmedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    protected $qrImage;

    /**
     * Create a new message instance.
     *
     * @param $qrImage
     */
    public function __construct($qrImage)
    {
        //
        $this->qrImage = $qrImage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): BookingConfirmedMail
    {
        return $this->markdown('mails.booking-confirmed', ['qrCode' => $this->qrImage]);
    }
}
