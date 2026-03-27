@extends('layouts.admin')

@section('title', 'Global Settings')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">System Settings</h2>
        <p class="text-sm text-gray-500 mt-1">Configure global platform toggles, contact details, and core logic.</p>
    </div>
</div>

<div x-data="{ activeTab: 'general' }" class="grid grid-cols-1 lg:grid-cols-4 gap-6">

    <!-- Vertical Tabs Sidebar -->
    <div class="col-span-1 border border-gray-100 bg-white rounded-xl shadow-sm p-4 h-fit sticky top-6">
        <nav class="flex flex-col space-y-1">
            <button @click="activeTab = 'general'" :class="{ 'bg-orange-50 text-orange-700 font-bold': activeTab === 'general', 'text-gray-600 hover:bg-gray-50 font-medium': activeTab !== 'general' }" class="text-left px-4 py-3 rounded-lg text-sm transition-colors flex items-center justify-between">
                <span><i class="fas fa-sliders-h w-5"></i> General</span>
                <i class="fas fa-chevron-right text-xs opacity-50" x-show="activeTab === 'general'"></i>
            </button>
            <button @click="activeTab = 'admissions'" :class="{ 'bg-orange-50 text-orange-700 font-bold': activeTab === 'admissions', 'text-gray-600 hover:bg-gray-50 font-medium': activeTab !== 'admissions' }" class="text-left px-4 py-3 rounded-lg text-sm transition-colors flex items-center justify-between">
                <span><i class="fas fa-user-graduate w-5"></i> Admissions</span>
                <i class="fas fa-chevron-right text-xs opacity-50" x-show="activeTab === 'admissions'"></i>
            </button>
            <button @click="activeTab = 'contact'" :class="{ 'bg-orange-50 text-orange-700 font-bold': activeTab === 'contact', 'text-gray-600 hover:bg-gray-50 font-medium': activeTab !== 'contact' }" class="text-left px-4 py-3 rounded-lg text-sm transition-colors flex items-center justify-between">
                <span><i class="fas fa-address-book w-5"></i> Contact Info</span>
                <i class="fas fa-chevron-right text-xs opacity-50" x-show="activeTab === 'contact'"></i>
            </button>
            <button @click="activeTab = 'social'" :class="{ 'bg-orange-50 text-orange-700 font-bold': activeTab === 'social', 'text-gray-600 hover:bg-gray-50 font-medium': activeTab !== 'social' }" class="text-left px-4 py-3 rounded-lg text-sm transition-colors flex items-center justify-between">
                <span><i class="fas fa-hashtag w-5"></i> Social Links</span>
                <i class="fas fa-chevron-right text-xs opacity-50" x-show="activeTab === 'social'"></i>
            </button>
        </nav>
    </div>

    <!-- Main Settings Form Area -->
    <div class="col-span-1 lg:col-span-3">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white border border-gray-100 rounded-xl shadow-sm p-6 sm:p-8">
            @csrf
            
            @foreach(['general', 'admissions', 'contact', 'social'] as $groupTab)
            <div x-show="activeTab === '{{ $groupTab }}'" x-cloak class="space-y-6">
                
                <div class="border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 capitalize">{{ $groupTab }} Settings</h3>
                    <p class="text-sm text-gray-500">Update the {{ $groupTab }} configurations applied globally across the KodeNest frontend.</p>
                </div>

                @if(isset($settings[$groupTab]))
                    @foreach($settings[$groupTab] as $setting)
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 py-2">
                            <div class="sm:w-1/3">
                                <label for="setting_{{ $setting->key }}" class="block text-sm font-semibold text-gray-900 pt-1">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>
                                <span class="text-xs text-gray-500 font-mono mt-0.5 block">KEY: {{ $setting->key }}</span>
                            </div>
                            
                            <div class="sm:w-2/3">
                                @if($setting->type === 'boolean')
                                    <!-- Custom Toggle Switch -->
                                    <label class="relative inline-flex items-center cursor-pointer mt-1">
                                        <input type="checkbox" name="settings[{{ $setting->key }}]" value="true" class="sr-only peer" {{ $setting->value === 'true' ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                        <span class="ml-3 text-sm font-medium text-gray-700 peer-checked:text-orange-600 transition-colors" x-text="$el.previousElementSibling.previousElementSibling.checked ? 'Enabled' : 'Disabled'">
                                            {{ $setting->value === 'true' ? 'Enabled' : 'Disabled' }}
                                        </span>
                                    </label>
                                @elseif($setting->type === 'text')
                                    <textarea id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" rows="3" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">{{ $setting->value }}</textarea>
                                @else
                                    <input type="text" id="setting_{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow text-sm">
                                @endif
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr class="border-gray-50 my-2">
                        @endif
                    @endforeach
                @else
                    <p class="text-sm text-gray-500 italic py-4">No settings configured for this category yet.</p>
                @endif
            </div>
            @endforeach

            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end">
                <button type="submit" class="px-6 py-2.5 text-sm font-bold text-white bg-gray-900 hover:bg-gray-800 rounded-lg shadow-sm transition-colors focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 flex items-center gap-2">
                    <i class="fas fa-save"></i> Save Global Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection