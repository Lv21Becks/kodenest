@extends('layouts.admin')

@section('title', 'Write Blog Post')
@section('header_title', 'Write New Blog Post')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('admin.blog-posts.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Title --}}
                        <div class="col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all font-bold text-lg">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="col-span-1">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <input type="text" name="category" id="category" value="{{ old('category') }}" required
                                list="categories"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">
                            <datalist id="categories">
                                <option value="Technology">
                                <option value="Education">
                                <option value="Success Stories">
                                <option value="Programming">
                                <option value="Career Tips">
                            </datalist>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Featured Image --}}
                        <div class="col-span-1">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image
                                URL</label>
                            <input type="url" name="featured_image" id="featured_image" value="{{ old('featured_image') }}"
                                placeholder="https://..."
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Excerpt --}}
                        <div class="col-span-2">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt (Short
                                Summary)</label>
                            <textarea name="excerpt" id="excerpt" rows="3" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">{{ old('excerpt') }}</textarea>
                            <p class="text-xs text-gray-400 mt-1">Displayed on the blog index page.</p>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Content --}}
                        <div class="col-span-2">
                            <label for="content" class="block text-sm font-medium text-gray-700">Full Content (supports
                                HTML)</label>
                            <textarea name="content" id="content" rows="12" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all font-mono text-sm">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Author --}}
                        <div class="col-span-1">
                            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                            <input type="text" name="author" id="author" value="{{ old('author', 'KodeNest') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">
                            @error('author')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Read Time --}}
                        <div class="col-span-1">
                            <label for="read_time" class="block text-sm font-medium text-gray-700">Read Time
                                (minutes)</label>
                            <input type="number" name="read_time" id="read_time" min="1" value="{{ old('read_time', 5) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">
                            @error('read_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Publish Switch --}}
                        <div class="col-span-2">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-100">
                                <input type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-brand-purple shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 focus:ring-opacity-50 h-5 w-5">
                                <div class="ml-3">
                                    <label for="published" class="font-medium text-gray-900">Publish Immediately</label>
                                    <p class="text-xs text-gray-500">If unchecked, this post will be saved as a draft.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('admin.blog-posts.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-purple/50 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-brand-purple border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-brand-purple/90 active:bg-brand-purple focus:outline-none focus:border-brand-purple focus:ring ring-brand-purple/50 disabled:opacity-25 transition ease-in-out duration-150">
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection