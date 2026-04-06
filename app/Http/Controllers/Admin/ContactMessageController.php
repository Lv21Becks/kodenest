<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        $unreadCount = ContactMessage::where('is_read', false)->count();
        return view('admin.contact-messages.index', compact('messages', 'unreadCount'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if (!$contactMessage->is_read) {
            $contactMessage->update(['is_read' => true, 'read_at' => now()]);
        }
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')->with('success', 'Message deleted.');
    }

    public function markAllRead()
    {
        ContactMessage::where('is_read', false)->update(['is_read' => true, 'read_at' => now()]);
        return back()->with('success', 'All messages marked as read.');
    }
}
