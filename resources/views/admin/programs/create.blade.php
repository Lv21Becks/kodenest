@extends('layouts.admin')

@section('title', 'Create Program')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Create New Program</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">Add a new course to the KodeNest curriculum.</p>
        </div>
        <a href="{{ route('admin.programs.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl shadow-sm hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left text-xs"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                placeholder="e.g. Full-Stack Web Development"
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm">
                            @error('title')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" id="description" rows="5" required
                                placeholder="A clear description of the program..."
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm resize-none">{{ old('description') }}</textarea>
                            @error('description')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="target_audience" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Target Audience <span class="text-red-500">*</span>
                            </label>
                            <textarea name="target_audience" id="target_audience" rows="2" required
                                placeholder="Who is this program for?"
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm resize-none">{{ old('target_audience') }}</textarea>
                            @error('target_audience')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="duration" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Duration <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="duration" id="duration" value="{{ old('duration') }}"
                                    placeholder="e.g. 12 weeks" required
                                    class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm">
                                @error('duration')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="order" class="block text-sm font-semibold text-gray-700 mb-1.5">Display Order</label>
                                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
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
                                placeholder="Python, Data Analysis, SQL, Machine Learning"
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm resize-none">{{ old('skills') }}</textarea>
                            @error('skills')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="tools" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Tools / Software
                                <span class="font-normal text-gray-400 ml-1">(comma-separated)</span>
                            </label>
                            <textarea name="tools" id="tools" rows="2"
                                placeholder="VS Code, Tableau, Figma"
                                class="w-full rounded-xl border border-gray-200 py-2.5 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow shadow-sm resize-none">{{ old('tools') }}</textarea>
                            @error('tools')<p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>@enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">

                {{-- Image Upload --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-sm font-bold text-gray-900">Program Image</h3>
                    </div>
                    <div class="p-6">
                        <label for="image_icon" class="block text-sm font-semibold text-gray-700 mb-2">
                            Logo / Icon
                        </label>
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-orange-300 transition-colors cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2"></i>
                            <p class="text-xs text-gray-400 font-medium mb-3">PNG, JPG, SVG up to 2MB</p>
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
                        <label class="flex items-center justify-between cursor-pointer group">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Active</p>
                                <p class="text-xs text-gray-400 mt-0.5">Visible on the public website</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" name="status" id="status" value="1" {{ old('status', true) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-10 h-6 bg-gray-200 peer-checked:bg-orange-500 rounded-full transition-colors"></div>
                                <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow peer-checked:translate-x-4 transition-transform"></div>
                            </div>
                        </label>

                        <div class="border-t border-gray-100 pt-4">
                            <label class="flex items-center justify-between cursor-pointer group">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Coming Soon</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Show "Coming Soon" badge</p>
                                </div>
                                <div class="relative">
                                    <input type="checkbox" name="coming_soon" id="coming_soon" value="1" {{ old('coming_soon') ? 'checked' : '' }} class="sr-only peer">
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
                    <i class="fas fa-plus text-xs"></i> Create Program
                </button>

            </div>
        </div>
    </form>
</div>
@endsection