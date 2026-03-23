@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')
@section('header_title', 'Newsletter')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Newsletter Subscribers</h1>
            <p class="text-gray-500 mt-1">Manage and export your newsletter audience.</p>
        </div>
        <div class="flex gap-3">
            <button type="button" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-50 transition-colors flex items-center gap-2 shadow-sm text-sm">
                <i class="fas fa-file-export"></i> Export CSV
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-sm font-bold text-gray-900">All Subscribers</h3>
            <span class="inline-flex items-center rounded-md bg-white px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">{{ $subscribers->total() ?? $subscribers->count() }} records</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-semibold text-gray-900">Email Address</th>
                        <th scope="col" class="px-6 py-3 font-semibold text-gray-900">Subscribed At</th>
                        <th scope="col" class="px-6 py-3 font-semibold text-gray-900 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($subscribers as $subscriber)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 ring-1 ring-inset ring-orange-500/20">
                                        <i class="fas fa-envelope text-xs"></i>
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $subscriber->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                <div class="flex items-center gap-1.5">
                                    <i class="far fa-clock"></i>
                                    {{ $subscriber->created_at->format('M d, Y h:i A') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.newsletter.destroy', $subscriber) }}" method="POST"
                                    class="inline-block opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Are you sure you want to remove this subscriber?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Remove Subscriber">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 ring-1 ring-inset ring-gray-500/10">
                                    <i class="fas fa-envelope-open-text text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-sm font-medium text-gray-900 mb-1">No subscribers yet</p>
                                <p class="text-xs">When users subscribe, they will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

            @if($subscribers->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $subscribers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection