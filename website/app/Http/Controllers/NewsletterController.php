<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = strtolower(trim($request->email));

        $existing = NewsletterSubscriber::where('email', $email)->first();

        if ($existing) {
            if ($existing->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already subscribed!'
                ]);
            } else {
                $existing->update([
                    'is_active'     => 1,
                    'subscribed_at' => now(),
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'You have been re-subscribed successfully!'
                ]);
            }
        }

        NewsletterSubscriber::create([
            'email'         => $email,
            'is_active'     => 1,
            'subscribed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!'
        ]);
    }
}
