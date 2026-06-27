<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    // public function submitForm(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone_number' => 'required|digits:10',
    //         'subject' => 'required|string|max:255',
    //         'message' => 'required|string',
    //     ]);

    //     try {
    //         // Store in database
    //         $contact = Contact::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'phone_number' => $request->phone_number,
    //             'subject' => $request->subject,
    //             'message' => $request->message,
    //         ]);

    //         // Send email to admin
    //         Mail::to('eswaranr.sts@gmail.com')->send(new ContactMessageMail($contact));

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Your message has been sent successfully!'
    //         ]);
    //     } catch (\Exception $e) {
    //         \Log::error('Contact Form Error: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Something went wrong. Please try again later.'
    //         ], 500);
    //     }
    // }

    public function submitForm(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'required|digits:10',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    try {
        // DB Save
        $contact = Contact::create($validated);

        // Mail send
        Mail::to('eswaranr.sts@gmail.com')
            ->send(new ContactMessageMail($contact));

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully!'
        ]);

    } catch (\Exception $e) {

        Log::error('Contact Error: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'Server error. Try again later.'
        ], 500);
    }
}
}
