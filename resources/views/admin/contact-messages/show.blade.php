@extends('layouts.admin')

@section('title', 'Contact Message')

@section('content')
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('admin.contact-messages.index') }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <h2 class="text-xl font-bold text-gray-900">Message from {{ $contactMessage->name }}</h2>
        <p class="text-sm text-gray-500 mt-0.5">{{ $contactMessage->created_at->format('M d, Y \a\t H:i') }}</p>
    </div>
</div>

<div class="max-w-2xl bg-white rounded-xl border border-gray-100 shadow-sm p-8 space-y-6">

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Name</p>
            <p class="font-semibold text-gray-900">{{ $contactMessage->name }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Subject</p>
            <p class="font-semibold text-gray-900">{{ $contactMessage->subject ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Email</p>
            <a href="mailto:{{ $contactMessage->email }}" class="font-semibold text-orange-600 hover:underline">{{ $contactMessage->email }}</a>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Phone</p>
            <a href="tel:{{ $contactMessage->phone }}" class="font-semibold text-gray-900">{{ $contactMessage->phone ?? 'N/A' }}</a>
        </div>
    </div>

    <div class="border-t border-gray-100 pt-6">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Message</p>
        <div class="bg-gray-50 rounded-xl p-5 text-gray-700 leading-relaxed whitespace-pre-wrap text-sm">{{ $contactMessage->message }}</div>
    </div>

    <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
        <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}"
           class="px-5 py-2.5 bg-orange-600 text-white text-sm font-bold rounded-lg hover:bg-orange-700 transition-colors">
            <i class="fas fa-reply mr-1.5"></i> Reply via Email
        </a>
        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" onsubmit="return confirm('Delete this message?')">
            @csrf @method('DELETE')
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                <i class="fas fa-trash mr-1.5"></i> Delete
            </button>
        </form>
    </div>
</div>
@endsection
