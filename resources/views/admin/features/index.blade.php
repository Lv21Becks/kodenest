@extends('layouts.admin')

@section('title', 'Manage Features')
@section('header_title', 'Features')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Homepage Features</h1>
            <p class="text-gray-500 mt-1">Manage the 'Why Choose Us' and key benefits content.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.features.create') }}"
                class="bg-orange-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-orange-700 transition-colors flex items-center gap-2 shadow-sm">
                <i class="fas fa-plus"></i> New Feature
            </a>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-sm font-bold text-gray-900">Active Features</h3>
            <span class="inline-flex items-center rounded-md bg-white px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">{{ $features->count() }} records</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-semibold text-gray-900 w-16">Sort</th>
                        <th scope="col" class="px-6 py-3 font-semibold text-gray-900">Feature</th>
                        <th scope="col" class="px-6 py-3 font-semibold text-gray-900">Status</th>
                        <th scope="col" class="px-6 py-3 font-semibold text-gray-900 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($features as $feature)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 text-sm text-gray-400 font-medium">
                                {{ str_pad($feature->sort_order, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600 ring-1 ring-inset ring-orange-500/20 shrink-0">
                                        <i class="{{ $feature->icon }}"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 mb-1 group-hover:text-orange-600 transition-colors">{{ $feature->title }}</div>
                                        <div class="text-xs text-gray-500 line-clamp-2 max-w-md">
                                            {{ $feature->description }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($feature->is_active)
                                    <span class="inline-flex items-center gap-1.5 rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.features.edit', $feature) }}"
                                        class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.features.destroy', $feature) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this feature?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 ring-1 ring-inset ring-gray-500/10">
                                    <i class="fas fa-star text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-sm font-medium mb-1">No homepage features configured</p>
                                <a href="{{ route('admin.features.create') }}"
                                    class="text-orange-600 hover:text-orange-700 font-medium text-sm">Add your first feature &rarr;</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection