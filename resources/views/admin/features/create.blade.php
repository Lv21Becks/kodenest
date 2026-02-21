@extends('layouts.admin')

@section('title', 'Add Feature')
@section('header_title', 'Add New Feature')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-plus mr-2 text-brand-purple"></i> Add New Feature
            </h2>
            <a href="{{ route('admin.features.index') }}"
                class="text-gray-500 hover:text-gray-700 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl mx-auto">
            <form action="{{ route('admin.features.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-purple focus:border-transparent outline-none transition-all placeholder-gray-400"
                            placeholder="e.g. Expert Instructors">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-purple focus:border-transparent outline-none transition-all placeholder-gray-400"
                            placeholder="Briefly explain this benefit...">{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">FontAwesome Icon Class</label>
                            <input type="text" name="icon" value="{{ old('icon') }}" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-purple focus:border-transparent outline-none transition-all placeholder-gray-400 font-mono text-sm"
                                placeholder="e.g. fas fa-chalkboard-teacher">
                            <p class="text-xs text-gray-500 mt-1">Visit <a href="https://fontawesome.com/search?o=r&m=free"
                                    target="_blank" class="text-brand-purple underline">FontAwesome</a> for icons.</p>
                            @error('icon') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-purple focus:border-transparent outline-none transition-all">
                            @error('sort_order') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', 1) ? 'checked' : '' }}
                            class="w-5 h-5 text-brand-purple border-gray-300 rounded focus:ring-brand-purple transition-all cursor-pointer">
                        <label for="is_active" class="text-sm font-medium text-gray-700 cursor-pointer">Active (Visible
                            on Homepage)</label>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-brand-purple text-white font-bold rounded-lg hover:bg-brand-purple/90 transition-all shadow-md">
                        Save Feature
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection