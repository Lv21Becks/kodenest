@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')


    <div class="p-8 max-w-5xl mx-auto">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <!-- General Settings -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-sliders-h text-brand-purple"></i> General Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Site Name</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'KodeNest' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Tagline</label>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>
                    <div class="col-span-full">
                        <label class="block text-gray-700 font-bold mb-2">Footer Description</label>
                        <textarea name="site_description" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">{{ $settings['site_description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-envelope text-brand-purple"></i> Contact Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Contact Email</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Contact Phone</label>
                        <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>
                    <div class="col-span-full">
                        <label class="block text-gray-700 font-bold mb-2">Address</label>
                        <textarea name="contact_address" rows="2"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">{{ $settings['contact_address'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-share-alt text-brand-purple"></i> Social Media Links
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2"><i class="fab fa-facebook text-blue-600 mr-1"></i>
                            Facebook</label>
                        <input type="text" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2"><i class="fab fa-twitter text-blue-400 mr-1"></i>
                            Twitter / X</label>
                        <input type="text" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2"><i
                                class="fab fa-instagram text-pink-600 mr-1"></i> Instagram</label>
                        <input type="text" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2"><i class="fab fa-linkedin text-blue-700 mr-1"></i>
                            LinkedIn</label>
                        <input type="text" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Branding -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-image text-brand-purple"></i> Branding
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Logo URL</label>
                        <input type="text" name="site_logo" value="{{ $settings['site_logo'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none"
                            placeholder="https://...">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Favicon URL</label>
                        <input type="text" name="site_favicon" value="{{ $settings['site_favicon'] ?? '' }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none"
                            placeholder="https://...">
                    </div>
                </div>
            </div>

            <div class="sticky bottom-4 z-50 flex justify-end">
                <button type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-brand-purple to-brand-pink text-white font-black text-lg rounded-xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all">
                    <i class="fas fa-save mr-2"></i> Save Settings
                </button>
            </div>
        </form>
    </div>
@endsection