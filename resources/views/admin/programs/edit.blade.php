@extends('layouts.admin')

@section('title', 'Edit Program')

@section('content')
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-3xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Edit Program
            </h2>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0 gap-2">
            <a href="{{ route('admin.programs.index') }}"
                class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </div>

    <!-- Hub Navigation Tabs -->
    <div class="border-b border-gray-200 mb-8 mt-6">
        <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
            <!-- Overview (Current) -->
            <a href="#"
                class="border-brand-purple text-brand-purple whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                <i class="fas fa-edit mr-2"></i> Overview
            </a>

            <!-- Enrollments -->
            <a href="{{ route('admin.students.index', ['program' => $program->slug]) }}"
                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium group">
                <i class="fas fa-users mr-2 group-hover:text-gray-500"></i> Enrollments
                <span
                    class="ml-2 bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs group-hover:bg-gray-200">{{ $enrollmentCount }}</span>
            </a>

            <!-- SEO Metadata -->
            @if($seoRecord)
                <a href="{{ route('admin.seo-meta.edit', $seoRecord->id) }}"
                    class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                    <i class="fas fa-search mr-2"></i> SEO Metadata
                    <span class="ml-2 text-green-600 bg-green-50 px-2 py-0.5 rounded-full text-xs font-semibold"><i
                            class="fas fa-check mr-1"></i> Ready</span>
                </a>
            @else
                <a href="{{ route('admin.seo-meta.create', ['page' => 'program:' . $program->slug, 'item_id' => $program->id, 'route_name' => 'programs.show']) }}"
                    class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                    <i class="fas fa-search mr-2"></i> SEO Metadata
                    <span class="ml-2 text-orange-600 bg-orange-50 px-2 py-0.5 rounded-full text-xs font-semibold"><i
                            class="fas fa-plus mr-1"></i> Add</span>
                </a>
            @endif

            <!-- Features -->
            <!-- Placeholder route until Features implemented -->
            <a href="#"
                class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium opacity-50 cursor-not-allowed"
                title="Coming Soon">
                <i class="fas fa-star mr-2"></i> Features
            </a>
        </nav>
    </div>

    <form action="{{ route('admin.programs.update', $program) }}" method="POST" class="mt-8" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Program Information</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Update the program details</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $program->title) }}" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">
                        @error('title')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-4">
                        <label for="image_icon" class="block text-sm font-medium leading-6 text-gray-900">Program Logo /
                            Icon (Image) - Overrides Emoji</label>

                        @if($program->image_icon)
                            <div class="mt-2 mb-2">
                                <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                                <img src="{{ asset('storage/' . $program->image_icon) }}" alt="Current Icon"
                                    class="h-12 w-12 object-contain bg-gray-50 rounded p-1 border">
                            </div>
                        @endif

                        <input type="file" name="image_icon" id="image_icon" accept="image/*"
                            class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand-purple file:text-white hover:file:bg-pink-600">
                        <p class="mt-1 text-xs text-gray-500">Upload to replace current image.</p>
                        @error('image_icon')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description
                            *</label>
                        <textarea name="description" id="description" rows="4" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">{{ old('description', $program->description) }}</textarea>
                        @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="duration" class="block text-sm font-medium leading-6 text-gray-900">Duration *</label>
                        <input type="text" name="duration" id="duration" value="{{ old('duration', $program->duration) }}"
                            required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">
                        @error('duration')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price (₦) *</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $program->price) }}" step="0.01"
                            min="0" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">
                        @error('price')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="col-span-full">
                        <label for="target_audience" class="block text-sm font-medium leading-6 text-gray-900">Target
                            Audience *</label>
                        <textarea name="target_audience" id="target_audience" rows="2" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">{{ old('target_audience', $program->target_audience) }}</textarea>
                        @error('target_audience')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="col-span-full">
                        <label for="skills" class="block text-sm font-medium leading-6 text-gray-900">Skills
                            (comma-separated) *</label>
                        <textarea name="skills" id="skills" rows="3" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">{{ old('skills', is_array($program->skills) ? implode(', ', $program->skills) : $program->skills) }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">Separate each skill with a comma</p>
                        @error('skills')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="col-span-full">
                        <label for="tools" class="block text-sm font-medium leading-6 text-gray-900">Tools / Software
                            (comma-separated)</label>
                        <textarea name="tools" id="tools" rows="2" placeholder="VS Code, Tableau, Figma"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">{{ old('tools', is_array($program->tools) ? implode(', ', $program->tools) : $program->tools) }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">Separate each tool with a comma</p>
                        @error('tools')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="order" class="block text-sm font-medium leading-6 text-gray-900">Display Order</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $program->order) }}" min="0"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">
                        @error('order')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-4">
                        <div class="flex items-center gap-6 flex-wrap">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $program->status) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-gray-300 text-brand-purple focus:ring-brand-purple">
                                <label for="status" class="text-sm font-medium leading-6 text-gray-900">Active (visible on
                                    website)</label>
                            </div>
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="coming_soon" id="coming_soon" value="1" {{ old('coming_soon', $program->coming_soon) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-gray-300 text-orange-500 focus:ring-orange-500">
                                <label for="coming_soon" class="text-sm font-medium leading-6 text-gray-900">Mark as <span
                                        class="text-orange-600 font-semibold">Coming Soon</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('admin.programs.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-brand-purple px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-pink-600">
                Update Program
            </button>
        </div>
    </form>
@endsection