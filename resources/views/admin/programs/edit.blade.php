@extends('layouts.admin')

@section('title', 'Edit Program')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <div class="flex items-center gap-3 text-sm font-medium text-gray-400 mb-1">
                <a href="{{ route('admin.programs.index') }}" class="hover:text-orange-600 transition-colors">Programs</a>
                <i class="fas fa-chevron-right text-[10px]"></i>
                <span class="text-gray-900 font-semibold">{{ $program->title }}</span>
            </div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Edit Program</h2>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.programs.show', $program) }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl shadow-sm hover:bg-gray-50 transition-colors">
                <i class="fas fa-eye text-xs"></i> View
            </a>
            <a href="{{ route('admin.programs.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl shadow-sm hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left text-xs"></i> Back
            </a>
        </div>
    </div>

    {{-- Hub Tabs --}}
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-6 overflow-x-auto">
            <a href="#" class="border-b-2 border-orange-500 text-orange-600 whitespace-nowrap py-3 px-1 text-sm font-bold">
                <i class="fas fa-edit mr-1.5"></i> Overview
            </a>
            <a href="{{ route('admin.students.index', ['program' => $program->slug]) }}"
                class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 px-1 text-sm font-semibold transition-colors">
                <i class="fas fa-users mr-1.5"></i> Enrollments
                <span class="ml-1.5 bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs">{{ $enrollmentCount }}</span>
            </a>
            @if($seoRecord)
                <a href="{{ route('admin.seo-meta.edit', $seoRecord->id) }}"
                    class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 px-1 text-sm font-semibold transition-colors">
                    <i class="fas fa-search mr-1.5"></i> SEO
                    <span class="ml-1.5 text-green-600 bg-green-50 px-2 py-0.5 rounded-full text-xs font-bold"><i class="fas fa-check mr-1"></i>Ready</span>
                </a>
            @else
                <a href="{{ route('admin.seo-meta.create', ['page' => 'program:' . $program->slug, 'item_id' => $program->id, 'route_name' => 'programs.show']) }}"
                    class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 px-1 text-sm font-semibold transition-colors">
                    <i class="fas fa-search mr-1.5"></i> SEO
                    <span class="ml-1.5 text-orange-600 bg-orange-50 px-2 py-0.5 rounded-full text-xs font-bold"><i class="fas fa-plus mr-1"></i>Add</span>
                </a>
            @endif
        </nav>
    </div>

    <form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Main Fields --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-sm font-bold text-gray-900">Program Information</h3>
                    </div>
                    <div class="p-6 space-y-5">

                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $program->title) }}" required
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm">
                            @error('title')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" id="description" rows="5" required
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm resize-none">{{ old('description', $program->description) }}</textarea>
                            @error('description')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="target_audience" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Target Audience <span class="text-red-500">*</span>
                            </label>
                            <textarea name="target_audience" id="target_audience" rows="2" required
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm resize-none">{{ old('target_audience', $program->target_audience) }}</textarea>
                            @error('target_audience')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="duration" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Duration <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="duration" id="duration"
                                    value="{{ old('duration', $program->duration) }}" required
                                    class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm">
                                @error('duration')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="order" class="block text-sm font-semibold text-gray-700 mb-1.5">Display Order</label>
                                <input type="number" name="order" id="order"
                                    value="{{ old('order', $program->order) }}" min="0"
                                    class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm">
                                @error('order')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="skills" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Skills <span class="text-red-500">*</span>
                                <span class="font-normal text-gray-400 ml-1">(comma-separated)</span>
                            </label>
                            <textarea name="skills" id="skills" rows="3" required
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm resize-none">{{ old('skills', is_array($program->skills) ? implode(', ', $program->skills) : $program->skills) }}</textarea>
                            @error('skills')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="tools" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Tools / Software
                                <span class="font-normal text-gray-400 ml-1">(comma-separated)</span>
                            </label>
                            <textarea name="tools" id="tools" rows="2"
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm resize-none">{{ old('tools', is_array($program->tools) ? implode(', ', $program->tools) : $program->tools) }}</textarea>
                            @error('tools')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">

                {{-- Current Image --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-sm font-bold text-gray-900">Program Image</h3>
                    </div>
                    <div class="p-6">
                        @if($program->photo_url)
                            <div class="mb-4 flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                                <img src="{{ $program->photo_url }}"
                                    alt="Current Icon" class="h-12 w-12 object-contain rounded-lg bg-white p-1 border border-gray-100">
                                <div>
                                    <p class="text-xs font-bold text-gray-700">Current Image</p>
                                    <p class="text-[10px] text-gray-400 font-medium">Upload new to replace</p>
                                </div>
                            </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-orange-300 transition-colors">
                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-300 mb-2"></i>
                            <input type="file" name="image_icon" id="image_icon" accept="image/*"
                                class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100 file:transition-colors cursor-pointer">
                        </div>
                        @error('image_icon')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Settings --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-sm font-bold text-gray-900">Settings</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <label class="flex items-center justify-between cursor-pointer">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Active</p>
                                <p class="text-xs text-gray-400 mt-0.5">Visible on the public website</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" name="status" id="status" value="1"
                                    {{ old('status', $program->status) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-10 h-6 bg-gray-200 peer-checked:bg-orange-500 rounded-full transition-colors"></div>
                                <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow peer-checked:translate-x-4 transition-transform"></div>
                            </div>
                        </label>
                        <div class="border-t border-gray-100 pt-4">
                            <label class="flex items-center justify-between cursor-pointer">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Coming Soon</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Show "Coming Soon" badge</p>
                                </div>
                                <div class="relative">
                                    <input type="checkbox" name="coming_soon" id="coming_soon" value="1"
                                        {{ old('coming_soon', $program->coming_soon) ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-10 h-6 bg-gray-200 peer-checked:bg-orange-500 rounded-full transition-colors"></div>
                                    <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow peer-checked:translate-x-4 transition-transform"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full py-3.5 bg-orange-600 hover:bg-orange-700 text-white font-bold text-sm rounded-xl shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-center gap-2">
                    <i class="fas fa-save text-xs"></i> Update Program
                </button>

            </div>
        </div>
    </form>
</div>
@endsection