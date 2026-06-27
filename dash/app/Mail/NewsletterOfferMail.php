<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterOfferMail extends Mailable
{
    use Queueable, SerializesModels;

    public $offerData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($offerData)
    {
        $this->offerData = $offerData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->offerData['subject'])
                    ->markdown('emails.newsletter_offer');
    }
}
