@extends('layouts.admin')

@section('title', 'Edit Testimonial')
@section('header_title', 'Edit Testimonial')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div class="col-span-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">Client Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Position --}}
                        <div class="col-span-1">
                            <label for="position" class="block text-sm font-medium text-gray-700">Position / Company</label>
                            <input type="text" name="position" id="position"
                                value="{{ old('position', $testimonial->position) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">
                            @error('position')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Profile Picture Upload --}}
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                            <div class="flex items-center gap-5">
                                {{-- Avatar Preview --}}
                                <div class="relative flex-shrink-0">
                                    @if($testimonial->image)
                                        <img id="avatar-img" src="{{ asset('storage/' . $testimonial->image) }}"
                                            alt="{{ $testimonial->name }}"
                                            class="w-20 h-20 rounded-full object-cover ring-2 ring-gray-200">
                                        <div id="avatar-initials"
                                            class="hidden w-20 h-20 rounded-full bg-gradient-to-br from-brand-purple to-pink-600 flex items-center justify-center text-white text-2xl font-bold ring-2 ring-gray-200">
                                            {{ substr($testimonial->name, 0, 1) }}{{ substr(explode(' ', $testimonial->name)[1] ?? '', 0, 1) }}
                                        </div>
                                    @else
                                        <div id="avatar-initials"
                                            class="w-20 h-20 rounded-full bg-gradient-to-br from-brand-purple to-pink-600 flex items-center justify-center text-white text-2xl font-bold ring-2 ring-gray-200">
                                            {{ substr($testimonial->name, 0, 1) }}{{ substr(explode(' ', $testimonial->name)[1] ?? '', 0, 1) }}
                                        </div>
                                        <img id="avatar-img" src="" alt=""
                                            class="hidden w-20 h-20 rounded-full object-cover ring-2 ring-gray-200">
                                    @endif
                                </div>

                                <div class="flex-1 space-y-2">
                                    <label for="image"
                                        class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $testimonial->image ? 'Replace Photo' : 'Choose Photo' }}
                                    </label>
                                    <input type="file" name="image" id="image" accept="image/*" class="hidden">

                                    @if($testimonial->image)
                                        <div id="remove-section" class="flex items-center gap-2">
                                            <input type="checkbox" name="remove_image" id="remove_image" value="1"
                                                class="rounded border-gray-300 text-red-500 shadow-sm h-4 w-4">
                                            <label for="remove_image" class="text-sm text-red-600 cursor-pointer">Remove
                                                current photo</label>
                                        </div>
                                    @endif

                                    <p class="text-xs text-gray-400">JPG, PNG, WebP — max 2 MB</p>
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="col-span-2">
                            <label for="content" class="block text-sm font-medium text-gray-700">Testimonial Content</label>
                            <textarea name="content" id="content" rows="4" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">{{ old('content', $testimonial->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Rating --}}
                        <div class="col-span-1">
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                            <input type="number" name="rating" id="rating" min="1" max="5"
                                value="{{ old('rating', $testimonial->rating) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">
                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Order --}}
                        <div class="col-span-1">
                            <label for="order" class="block text-sm font-medium text-gray-700">Display Order</label>
                            <input type="number" name="order" id="order" min="0"
                                value="{{ old('order', $testimonial->order) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 transition-all">
                            <p class="text-xs text-gray-400 mt-1">Lower numbers appear first</p>
                            @error('order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Switches --}}
                        <div class="col-span-2 flex items-center space-x-8">
                            <div class="flex items-center">
                                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $testimonial->status) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-brand-purple shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 focus:ring-opacity-50 h-5 w-5">
                                <label for="status" class="ml-2 block text-sm text-gray-900">Active</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $testimonial->featured) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-brand-purple shadow-sm focus:border-brand-purple focus:ring focus:ring-brand-purple/20 focus:ring-opacity-50 h-5 w-5">
                                <label for="featured" class="ml-2 block text-sm text-gray-900">Featured</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('admin.testimonials.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-purple/50 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-brand-purple border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-brand-purple/90 active:bg-brand-purple focus:outline-none focus:border-brand-purple focus:ring ring-brand-purple/50 disabled:opacity-25 transition ease-in-out duration-150">
                            Update Testimonial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const avatarImg = document.getElementById('avatar-img');
        const avatarInitials = document.getElementById('avatar-initials');
        const removeCheckbox = document.getElementById('remove_image');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    avatarImg.src = e.target.result;
                    avatarImg.classList.remove('hidden');
                    if (avatarInitials) avatarInitials.classList.add('hidden');
                };
                reader.readAsDataURL(file);
                // Uncheck remove if a new file is chosen
                if (removeCheckbox) removeCheckbox.checked = false;
            }
        });

        // If "remove" is checked, show initials placeholder
        if (removeCheckbox) {
            removeCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    avatarImg.classList.add('hidden');
                    if (avatarInitials) avatarInitials.classList.remove('hidden');
                    imageInput.value = '';
                } else {
                    avatarImg.classList.remove('hidden');
                    if (avatarInitials) avatarInitials.classList.add('hidden');
                }
            });
        }
    </script>
@endsection