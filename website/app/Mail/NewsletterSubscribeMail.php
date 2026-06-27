<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewsletterSubscribeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Newsletter Subscription'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-subscribe',
            with: [
                'email' => $this->email
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
