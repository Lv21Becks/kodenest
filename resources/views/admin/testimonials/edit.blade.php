@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('admin.testimonials.index') }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Edit Testimonial</h2>
        <p class="text-sm text-gray-500 mt-0.5">Updating review from <strong>{{ $testimonial->name }}</strong></p>
    </div>
</div>

<div class="max-w-2xl">
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data"
        class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        {{-- Name & Position --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Student Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">
                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Role / Program <span class="text-red-500">*</span></label>
                <input type="text" name="position" value="{{ old('position', $testimonial->position) }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">
                @error('position')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Content --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Testimonial <span class="text-red-500">*</span></label>
            <textarea name="content" rows="4" required
                class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">{{ old('content', $testimonial->content) }}</textarea>
            @error('content')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>

        {{-- Rating --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Star Rating <span class="text-red-500">*</span></label>
            <div class="flex items-center gap-2">
                @for($i = 1; $i <= 5; $i++)
                <label class="cursor-pointer">
                    <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" {{ old('rating', $testimonial->rating) == $i ? 'checked' : '' }}>
                    <span class="text-2xl peer-checked:text-amber-400 text-gray-200 hover:text-amber-300 transition-colors select-none">★</span>
                </label>
                @endfor
            </div>
            @error('rating')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>

        {{-- Current Photo --}}
        @if($testimonial->image)
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Current Photo</label>
            <div class="flex items-center gap-4">
                <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->name }}"
                    class="w-16 h-16 rounded-full object-cover ring-2 ring-gray-100">
                <div>
                    <label class="flex items-center gap-2 cursor-pointer text-sm text-red-600 hover:text-red-800 font-medium">
                        <input type="checkbox" name="remove_image" value="1" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        Remove current photo
                    </label>
                </div>
            </div>
        </div>
        @endif

        {{-- New Photo --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">{{ $testimonial->image ? 'Replace Photo' : 'Upload Photo' }} (optional)</label>
            <input type="file" name="image" accept="image/*"
                class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition-colors cursor-pointer">
            @error('image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>

        {{-- Sort Order & Options --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Display Order</label>
                <input type="number" name="order" value="{{ old('order', $testimonial->order) }}" min="0"
                    class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Options</label>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $testimonial->featured) ? 'checked' : '' }} class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                        <span class="text-sm font-medium text-gray-700">Mark as Featured</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="status" value="1" {{ old('status', $testimonial->status) ? 'checked' : '' }} class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <span class="text-sm font-medium text-gray-700">Approved (Visible)</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-2 border-t border-gray-100">
            <button type="submit"
                class="px-6 py-2.5 text-sm font-bold text-white bg-orange-600 hover:bg-orange-700 rounded-lg shadow-sm transition-colors focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                <i class="fas fa-save mr-1.5"></i> Save Changes
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection