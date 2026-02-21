@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 font-sans">
        {{-- Toolbar --}}
        <div class="px-6 py-6 border-b border-gray-100 flex justify-end">
            <a href="{{ route('admin.blog-posts.create') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-brand-purple to-brand-pink px-6 py-3 text-sm font-bold text-white shadow-md hover:shadow-xl transition-all duration-200">
                <i class="fas fa-pen-nib text-xs"></i>
                Write New Post
            </a>
        </div>

        {{-- Table --}}
        <div class="flow-root">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">Post</th>
                                <th class="px-3 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">Category</th>
                                <th class="px-3 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">Author</th>
                                <th class="px-3 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider font-heading">Status</th>
                                <th class="relative py-4 pl-3 pr-6 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-transparent">
                            @forelse ($posts as $post)
                                <tr class="hover:bg-red-50/50 transition-colors duration-200">
                                    <td class="whitespace-nowrap py-4 pl-6 pr-3">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-14 w-20">
                                                <img class="h-14 w-20 rounded-lg object-cover border border-gray-100 shadow-sm"
                                                    src="{{ $post->featured_image ?? 'https://via.placeholder.com/150' }}"
                                                    alt="{{ $post->title }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900 font-heading line-clamp-1 hover:text-red-600 transition-colors">{{ $post->title }}</div>
                                                <div class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                                    <i class="far fa-calendar-alt text-[10px]"></i>
                                                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                            {{ $post->category }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center text-red-600 text-xs font-bold">
                                                {{ substr($post->author ?? 'A', 0, 1) }}
                                            </div>
                                            <span>{{ $post->author ?? 'Admin' }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @if ($post->published)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                                class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="View Live">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <a href="{{ route('admin.blog-posts.edit', $post) }}"
                                                class="p-2 text-gray-400 hover:text-brand-purple hover:bg-purple-50 rounded-lg transition-all" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="inline-block"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-10 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                                <i class="fas fa-feather-alt text-gray-400 text-xl"></i>
                                            </div>
                                            <p class="font-medium text-gray-900">No blog posts found</p>
                                            <a href="{{ route('admin.blog-posts.create') }}"
                                                class="text-red-600 hover:text-red-700 font-medium mt-1">Start writing your first post &rarr;</a>
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