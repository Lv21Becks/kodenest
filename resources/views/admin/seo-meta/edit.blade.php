@extends('layouts.admin')

@section('title', 'Edit SEO Meta')

@section('content')
    <header class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
        <div class="flex items-center justify-between px-8 py-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.seo-meta.index') }}"
                    class="p-2 hover:bg-gray-100 rounded-lg transition-colors text-gray-600">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-black text-gray-800">Edit SEO: <span
                            class="capitalize text-brand-purple">{{ $seoMetum->page }}</span></h1>
                </div>
            </div>
        </div>
    </header>

    <div class="p-8 max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.seo-meta.update', $seoMetum->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Meta Title</label>
                        <input type="text" name="title" value="{{ old('title', $seoMetum->title) }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Recommended length: 50-60 characters</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Meta Description</label>
                        <textarea name="description" rows="3" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">{{ old('description', $seoMetum->description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Recommended length: 150-160 characters</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Keywords (Optional)</label>
                        <input type="text" name="keywords" value="{{ old('keywords', $seoMetum->keywords) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">OG Image URL (Optional)</label>
                        <div class="flex gap-2">
                            <input type="text" name="og_image" value="{{ old('og_image', $seoMetum->og_image) }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
                    <a href="{{ route('admin.seo-meta.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors">Cancel</a>
                    <button type="submit"
                        class="px-6 py-3 bg-brand-purple text-white font-bold rounded-lg hover:bg-brand-pink transition-colors">
                        <i class="fas fa-save mr-2"></i>Update Metadata
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection