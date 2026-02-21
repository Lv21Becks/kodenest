@extends('layouts.admin')

@section('title', 'Manage Features')
@section('header_title', 'Features')

@section('content')
    <div class="relative group overflow-hidden bg-white/60 backdrop-blur-xl rounded-2xl border border-white/20 shadow-sm font-sans">
        {{-- Header --}}
        <div class="px-6 py-6 border-b border-gray-100/50 bg-gradient-to-r from-blue-50 via-white to-transparent">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 font-heading">Features</h1>
                    <p class="mt-1 text-sm text-gray-500">Manage 'Why Choose Us' content</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a href="{{ route('admin.features.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-500/30 hover:bg-blue-700 hover:shadow-blue-500/40 transition-all duration-200">
                        <i class="fas fa-plus text-xs"></i>
                        Add New Feature
                    </a>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="flow-root">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">Sort</th>
                                <th class="px-3 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">Icon</th>
                                <th class="px-3 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">Title</th>
                                <th class="px-3 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">Description</th>
                                <th class="px-3 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading text-center">Active</th>
                                <th class="relative py-4 pl-3 pr-6 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-transparent">
                            @forelse($features as $feature)
                                <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                    <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm text-gray-500 font-mono">
                                        {{ $feature->sort_order }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 border border-blue-200">
                                            <i class="{{ $feature->icon }}"></i>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 font-heading">
                                        {{ $feature->title }}
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-500 max-w-xs truncate">
                                        {{ Str::limit($feature->description, 50) }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-center">
                                        @if($feature->is_active)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Yes
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> No
                                            </span>
                                        @endif
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.features.edit', $feature) }}"
                                                class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.features.destroy', $feature) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this feature?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-10 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                                <i class="fas fa-star text-gray-400 text-xl"></i>
                                            </div>
                                            <p class="font-medium text-gray-900">No features found</p>
                                            <a href="{{ route('admin.features.create') }}"
                                                class="text-blue-600 hover:text-blue-700 font-medium mt-1">Add your first feature &rarr;</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection