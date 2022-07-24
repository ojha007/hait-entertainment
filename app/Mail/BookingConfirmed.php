<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BookingConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    /**
     * @var array
     */
    protected $attributes;
    private $qrCode;

    /**
     * Create a new message instance.
     *
     * @param array $attributes
     * @param $qrCode
     */
    public function __construct(array $attributes, $qrCode)
    {
        $this->attributes = $attributes;
        $this->qrCode = $qrCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): BookingConfirmed
    {
        return $this->markdown('emails.booking.confirmed', [
            'attributes' => $this->attributes,
            'qrCode' => $this->qrCode
        ]);
    }
}
