@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')


    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Site Settings</h1>
                <p class="text-gray-500 mt-1">Configure general platform identity and contact details.</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- General Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-sliders-h text-orange-600"></i> General Information
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Site Name</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'KodeNest' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Tagline</label>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                    </div>
                    <div class="col-span-full">
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Footer Description</label>
                        <textarea name="site_description" rows="3"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">{{ $settings['site_description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-envelope text-orange-600"></i> Contact Information
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Contact Email</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Contact Phone</label>
                        <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                    </div>
                    <div class="col-span-full">
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Address</label>
                        <textarea name="contact_address" rows="2"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">{{ $settings['contact_address'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-share-nodes text-orange-600"></i> Social Media Links
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5"><i class="fab fa-facebook text-blue-600 mr-1.5"></i> Facebook</label>
                        <input type="url" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5"><i class="fab fa-twitter text-blue-400 mr-1.5"></i> Twitter / X</label>
                        <input type="url" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5"><i class="fab fa-instagram text-pink-600 mr-1.5"></i> Instagram</label>
                        <input type="url" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5"><i class="fab fa-linkedin text-blue-700 mr-1.5"></i> LinkedIn</label>
                        <input type="url" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                    </div>
                </div>
            </div>

            <!-- Branding -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-image text-orange-600"></i> Branding
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Logo URL</label>
                        <input type="url" name="site_logo" value="{{ $settings['site_logo'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white"
                            placeholder="https://...">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Favicon URL</label>
                        <input type="url" name="site_favicon" value="{{ $settings['site_favicon'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white"
                            placeholder="https://...">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 pb-8">
                <button type="submit"
                    class="px-6 py-2.5 bg-orange-600 text-white font-semibold rounded-lg shadow-sm hover:bg-orange-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </div>
        </form>
    </div>
@endsection