@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Contact Messages</h2>
        <p class="text-sm text-gray-500 mt-0.5">Messages received from the public contact form.</p>
    </div>
    @if($unreadCount > 0)
        <form action="{{ route('admin.contact-messages.mark-all-read') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 text-sm font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                <i class="fas fa-check-double mr-1.5"></i> Mark All Read
            </button>
        </form>
    @endif
</div>

@if(session('success'))
    <div class="mb-4 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-semibold">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    @forelse($messages as $message)
        <div class="flex items-start gap-4 px-6 py-5 border-b border-gray-100 hover:bg-gray-50 transition-colors {{ !$message->is_read ? 'bg-orange-50/40' : '' }}">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-400 flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr($message->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="font-bold text-gray-900 text-sm">{{ $message->name }}</span>
                    @if(!$message->is_read)
                        <span class="px-2 py-0.5 bg-orange-100 text-orange-600 text-xs font-bold rounded-full">New</span>
                    @endif
                    <span class="text-xs text-gray-400 ml-auto">{{ $message->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs text-gray-500 mt-0.5">
                    <a href="mailto:{{ $message->email }}" class="hover:text-orange-600 transition-colors">{{ $message->email }}</a>
                    @if($message->phone) · <a href="tel:{{ $message->phone }}" class="hover:text-orange-600 transition-colors">{{ $message->phone }}</a> @endif
                    @if($message->subject) · <span class="text-gray-600 font-medium">{{ ucfirst($message->subject) }}</span> @endif
                </p>
                <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $message->message }}</p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('admin.contact-messages.show', $message) }}"
                   class="px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-orange-100 hover:text-orange-700 rounded-lg transition-colors">
                    View
                </a>
                <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST"
                      onsubmit="return confirm('Delete this message?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-500 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-center py-20 text-gray-400">
            <i class="fas fa-inbox text-4xl mb-4"></i>
            <p class="font-medium">No messages yet</p>
        </div>
    @endforelse
</div>

{{ $messages->links() }}
@endsection
