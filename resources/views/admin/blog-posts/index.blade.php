@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Blog Posts</h1>
            <p class="text-gray-500 mt-1">Manage and publish content for the KodeNest blog.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.blog-posts.create') }}"
                class="bg-orange-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-orange-700 transition-colors flex items-center gap-2 shadow-sm">
                <i class="fas fa-plus"></i> New Post
            </a>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-sm font-bold text-gray-900">Published & Drafts</h3>
            <span class="inline-flex items-center rounded-md bg-white px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">{{ $posts->count() }} records</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap text-left text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-semibold text-gray-900">Post</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-gray-900">Category</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-gray-900">Author</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-gray-900">Status</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-gray-900 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($posts as $post)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="flex-shrink-0 h-12 w-16">
                                                <img class="h-12 w-16 rounded-md object-cover border border-gray-200 shadow-sm"
                                                    src="{{ $post->featured_image ? (Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : 'https://via.placeholder.com/150' }}"
                                                    alt="{{ $post->title }}">
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900 line-clamp-1 group-hover:text-orange-600 transition-colors">{{ $post->title }}</div>
                                                <div class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                                    <i class="far fa-calendar-alt"></i>
                                                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            {{ $post->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 text-xs font-bold ring-1 ring-inset ring-orange-500/20">
                                                {{ substr($post->author ?? 'A', 0, 1) }}
                                            </div>
                                            <span class="text-gray-700 font-medium">{{ $post->author ?? 'Admin' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($post->published)
                                            <span class="inline-flex items-center gap-1.5 rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                                class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="View Live">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <a href="{{ route('admin.blog-posts.edit', $post) }}"
                                                class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this post?');">
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
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 ring-1 ring-inset ring-gray-500/10">
                                            <i class="fas fa-feather-alt text-gray-400 text-2xl"></i>
                                        </div>
                                        <p class="text-sm font-medium mb-1">No blog posts found</p>
                                        <a href="{{ route('admin.blog-posts.create') }}"
                                            class="text-orange-600 hover:text-orange-700 font-medium text-sm">Start writing your first post &rarr;</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection