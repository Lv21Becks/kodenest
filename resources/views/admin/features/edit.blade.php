@extends('layouts.admin')

@section('title', 'Edit Feature')

@section('content')
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('admin.features.index') }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Edit Feature</h2>
        <p class="text-sm text-gray-500 mt-0.5">Editing: <strong>{{ $feature->title }}</strong></p>
    </div>
</div>

<div class="max-w-2xl">
    <form action="{{ route('admin.features.update', $feature) }}" method="POST"
        class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $feature->title) }}" required
                class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">
            @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
            <textarea name="description" rows="3" required
                class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">{{ old('description', $feature->description) }}</textarea>
            @error('description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">FontAwesome Icon Class <span class="text-red-500">*</span></label>
                <input type="text" name="icon" value="{{ old('icon', $feature->icon) }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm font-mono"
                    placeholder="e.g. fas fa-chalkboard-teacher">
                <p class="mt-1.5 text-xs text-gray-400">
                    Browse at <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="text-orange-500 hover:underline font-medium">fontawesome.com</a>
                </p>
                @error('icon')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $feature->sort_order) }}" min="0"
                    class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">
                <p class="mt-1.5 text-xs text-gray-400">Lower numbers appear first.</p>
                @error('sort_order')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Current Icon Preview --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Current Icon</label>
            <div class="w-14 h-14 rounded-xl bg-orange-50 ring-1 ring-orange-200 flex items-center justify-center text-orange-600">
                <i class="{{ $feature->icon }} text-2xl"></i>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $feature->is_active) ? 'checked' : '' }}
                class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500 transition-all cursor-pointer">
            <label for="is_active" class="text-sm font-medium text-gray-700 cursor-pointer">Active (Visible on Homepage)</label>
        </div>

        <div class="flex items-center gap-4 pt-2 border-t border-gray-100">
            <button type="submit"
                class="px-6 py-2.5 text-sm font-bold text-white bg-orange-600 hover:bg-orange-700 rounded-lg shadow-sm transition-colors focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                <i class="fas fa-save mr-1.5"></i> Save Changes
            </button>
            <a href="{{ route('admin.features.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection