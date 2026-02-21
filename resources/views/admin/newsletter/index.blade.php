@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')
@section('header_title', 'Newsletter')

@section('content')
    <div
        class="relative group overflow-hidden bg-white/60 backdrop-blur-xl rounded-2xl border border-white/20 shadow-sm font-sans">
        {{-- Header --}}
        <div class="px-6 py-6 border-b border-gray-100/50 bg-gradient-to-r from-orange-50 via-white to-transparent">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 font-heading">Subscribers</h1>
                <p class="mt-1 text-sm text-gray-500">Manage your newsletter audience</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="flow-root">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th
                                    class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">
                                    Email</th>
                                <th
                                    class="px-3 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">
                                    Subscribed At</th>
                                <th class="relative py-4 pl-3 pr-6 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-transparent">
                            @forelse($subscribers as $subscriber)
                                <tr class="hover:bg-orange-50/50 transition-colors duration-200">
                                    <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                                        {{ $subscriber->email }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center gap-1.5">
                                            <i class="far fa-clock text-orange-400"></i>
                                            {{ $subscriber->created_at->format('M d, Y h:i A') }}
                                        </div>
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium sm:pr-6">
                                        <form action="{{ route('admin.newsletter.destroy', $subscriber) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                                title="Remove Subscriber">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-3 py-10 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                                <i class="fas fa-envelope-open-text text-gray-400 text-xl"></i>
                                            </div>
                                            <p class="font-medium text-gray-900">No subscribers yet</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($subscribers->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $subscribers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection