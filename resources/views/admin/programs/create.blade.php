@extends('layouts.admin')

@section('title', 'Create Program')

@section('content')
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-3xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Create New
                Program</h2>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">
            <a href="{{ route('admin.programs.index') }}"
                class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </div>

    <form action="{{ route('admin.programs.store') }}" method="POST" class="mt-8" enctype="multipart/form-data">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Program Information</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Enter the details for the new program</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">
                        @error('title')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-4">
                        <label for="image_icon" class="block text-sm font-medium leading-6 text-gray-900">Program Logo /
                            Icon (Image) - Overrides Emoji</label>
                        <input type="file" name="image_icon" id="image_icon" accept="image/*"
                            class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand-purple file:text-white hover:file:bg-pink-600">
                        @error('image_icon')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description
                            *</label>
                        <textarea name="description" id="description" rows="4" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">{{ old('description') }}</textarea>
                        @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="duration" class="block text-sm font-medium leading-6 text-gray-900">Duration *</label>
                        <input type="text" name="duration" id="duration" value="{{ old('duration') }}"
                            placeholder="e.g., 12 weeks" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">
                        @error('duration')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>



                    <div class="col-span-full">
                        <label for="target_audience" class="block text-sm font-medium leading-6 text-gray-900">Target
                            Audience *</label>
                        <textarea name="target_audience" id="target_audience" rows="2" required
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">{{ old('target_audience') }}</textarea>
                        @error('target_audience')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="col-span-full">
                        <label for="skills" class="block text-sm font-medium leading-6 text-gray-900">Skills
                            (comma-separated) *</label>
                        <textarea name="skills" id="skills" rows="3" required placeholder="Python, Data Analysis, SQL"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">{{ old('skills') }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">Separate each skill with a comma</p>
                        @error('skills')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="col-span-full">
                        <label for="tools" class="block text-sm font-medium leading-6 text-gray-900">Tools / Software
                            (comma-separated)</label>
                        <textarea name="tools" id="tools" rows="2" placeholder="VS Code, Tableau, Figma"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">{{ old('tools') }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">Separate each tool with a comma</p>
                        @error('tools')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="order" class="block text-sm font-medium leading-6 text-gray-900">Display Order</label>
                        <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brand-purple px-3">
                        @error('order')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-4">
                        <div class="flex items-center gap-6 flex-wrap">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="status" id="status" value="1" {{ old('status', true) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-gray-300 text-brand-purple focus:ring-brand-purple">
                                <label for="status" class="text-sm font-medium leading-6 text-gray-900">Active (visible on
                                    website)</label>
                            </div>
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="coming_soon" id="coming_soon" value="1" {{ old('coming_soon') ? 'checked' : '' }}
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
                class="rounded-md bg-brand-purple px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-pink-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-purple">
                Create Program
            </button>
        </div>
    </form>
@endsection