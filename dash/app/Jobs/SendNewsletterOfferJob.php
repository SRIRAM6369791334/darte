<?php

namespace App\Jobs;

use App\Mail\NewsletterOfferMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendNewsletterOfferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $offerData;

    public function __construct(array $offerData)
    {
        $this->offerData = $offerData;
    }

    public function handle()
    {
        $subscribers = NewsletterSubscriber::where('is_active', 1)->get();

        foreach ($subscribers as $subscriber) {
            try {
                // FIX: correct route parameter name is 'encodedEmail'
                $data = array_merge($this->offerData, [
                    'unsubscribe_url' => route('newsletter.unsubscribe', [
                        'encodedEmail' => base64_encode($subscriber->email)
                    ]),
                ]);

                Mail::to($subscriber->email)->send(new NewsletterOfferMail($data));
                Log::info("Newsletter offer sent to: " . $subscriber->email);

            } catch (\Exception $e) {
                Log::error("Failed to send newsletter to {$subscriber->email}: " . $e->getMessage());
            }
        }
    }
}
