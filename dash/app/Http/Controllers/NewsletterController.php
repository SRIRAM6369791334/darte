<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterOfferMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function index()
    {
        $subscribers   = NewsletterSubscriber::orderByDesc('id')->paginate(20);
        $totalCount    = NewsletterSubscriber::count();
        $activeCount   = NewsletterSubscriber::where('is_active', 1)->count();
        $inactiveCount = NewsletterSubscriber::where('is_active', 0)->count();

        return view('pages.newsletter', compact('subscribers', 'totalCount', 'activeCount', 'inactiveCount'));
    }

    public function toggleStatus($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->update(['is_active' => !$subscriber->is_active]);

        return back()->with('success', 'Subscriber status updated successfully!');
    }

    public function destroy($id)
    {
        NewsletterSubscriber::findOrFail($id)->delete();

        return back()->with('success', 'Subscriber removed successfully!');
    }

    /**
     * Send offer email directly to all active subscribers.
     * Sends one-by-one and reports success/failure count.
     */
    public function sendOffer(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'link'    => 'nullable|url',
        ]);

        $subscribers = NewsletterSubscriber::where('is_active', 1)->get();

        if ($subscribers->isEmpty()) {
            return back()->with('error', 'No active subscribers found. Cannot send offer.');
        }

        $sent   = 0;
        $failed = 0;

        foreach ($subscribers as $subscriber) {
            try {
                $offerData = [
                    'subject'         => $request->subject,
                    'title'           => $request->title,
                    'message'         => $request->message,
                    'link'            => $request->link ?? url('/'),
                    'unsubscribe_url' => route('newsletter.unsubscribe', [
                        'encodedEmail' => base64_encode($subscriber->email),
                    ]),
                ];

                Mail::to($subscriber->email)->send(new NewsletterOfferMail($offerData));
                $sent++;
                Log::info("Newsletter offer sent to: {$subscriber->email}");

            } catch (\Exception $e) {
                $failed++;
                Log::error("Failed to send newsletter to {$subscriber->email}: " . $e->getMessage());
            }
        }

        if ($failed === 0) {
            return back()->with('success', "✅ Offer email sent successfully to {$sent} subscriber(s)!");
        } elseif ($sent === 0) {
            return back()->with('error', "❌ Failed to send email to all {$failed} subscriber(s). Check mail config.");
        } else {
            return back()->with('success', "⚠️ Sent to {$sent} subscriber(s). Failed: {$failed}. Check logs.");
        }
    }

    /**
     * Unsubscribe via email link — no login required.
     */
    public function unsubscribe($encodedEmail)
    {
        $email      = base64_decode($encodedEmail);
        $subscriber = NewsletterSubscriber::where('email', $email)->first();

        if ($subscriber) {
            $subscriber->update(['is_active' => 0]);
            return response('
                <div style="font-family:sans-serif;text-align:center;padding:60px;">
                    <h2 style="color:#28a745;">✅ Unsubscribed Successfully</h2>
                    <p>You have been removed from our newsletter list.</p>
                </div>
            ');
        }

        return response('
            <div style="font-family:sans-serif;text-align:center;padding:60px;">
                <h2 style="color:#dc3545;">❌ Not Found</h2>
                <p>This email is not in our subscriber list.</p>
            </div>
        ');
    }
}
