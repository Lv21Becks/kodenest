<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Save to database
        $msg = ContactMessage::create($validated);

        // Send email notification to admin
        try {
            Mail::raw(
                "New contact message from {$msg->name} ({$msg->email})\n\n" .
                "Phone: " . ($msg->phone ?? 'N/A') . "\n" .
                "Subject: " . ($msg->subject ?? 'N/A') . "\n\n" .
                "Message:\n{$msg->message}",
                function ($mail) use ($msg) {
                    $mail->to(config('mail.from.address', 'Kodenestlimited@gmail.com'))
                         ->subject("📬 New Contact Message: {$msg->subject}")
                         ->replyTo($msg->email, $msg->name);
                }
            );
        } catch (\Exception $e) {
            // Silent fail — message is saved in DB even if email fails
        }

        return back()->with('success', 'Your message has been sent! We will get back to you within 24 hours.');
    }
}
