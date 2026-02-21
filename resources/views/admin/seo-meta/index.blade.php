@extends('layouts.admin')

@section('title', 'SEO Meta')

@section('content')

    <div class="p-8">
        <!-- Tabs / Sections -->
        <div class="space-y-12">

            <!-- Static Pages Section -->
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-brand-purple/10 rounded-lg flex items-center justify-center text-brand-purple">
                        <i class="fas fa-columns text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Static Pages</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($staticPages as $page)
                        @php
                            $meta = $seoMeta[$page] ?? null;
                            $isConfigured = !is_null($meta);
                        @endphp
                        <div
                            class="bg-white rounded-2xl shadow-sm overflow-hidden border {{ $isConfigured ? 'border-green-200' : 'border-gray-100' }} hover:shadow-md transition-all">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div
                                        class="p-3 {{ $isConfigured ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }} rounded-lg">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold {{ $isConfigured ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $isConfigured ? 'CUSTOMIZED' : 'DEFAULT' }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-800 mb-2 capitalize">{{ $page }} Page</h3>

                                @if($isConfigured)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $meta->description }}</p>
                                    <div class="text-xs text-gray-400 mb-6">
                                        Updated: {{ $meta->updated_at->diffForHumans() }}
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 mb-6 italic">Using system defaults.</p>
                                @endif

                                <div>
                                    @if($isConfigured)
                                        <a href="{{ route('admin.seo-meta.edit', $meta->id) }}"
                                            class="block w-full text-center px-4 py-2 bg-brand-purple text-white font-bold rounded-lg hover:bg-brand-pink transition-colors">
                                            <i class="fas fa-edit mr-2"></i>Edit Metadata
                                        </a>
                                    @else
                                        <a href="{{ route('admin.seo-meta.create', ['page' => $page]) }}"
                                            class="block w-full text-center px-4 py-2 bg-gray-800 text-white font-bold rounded-lg hover:bg-black transition-colors">
                                            <i class="fas fa-plus mr-2"></i>Configure
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Programs Section -->
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                        <i class="fas fa-graduation-cap text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Programs (Dynamic)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($programs as $program)
                        @php
                            $key = 'program:' . $program->slug;
                            $meta = $seoMeta[$key] ?? null;
                            $isConfigured = !is_null($meta);
                        @endphp
                        <div
                            class="bg-white rounded-2xl shadow-sm overflow-hidden border {{ $isConfigured ? 'border-green-200' : 'border-blue-100' }} hover:shadow-md transition-all">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div
                                        class="p-3 {{ $isConfigured ? 'bg-green-100 text-green-600' : 'bg-blue-50 text-blue-500' }} rounded-lg">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold {{ $isConfigured ? 'bg-green-100 text-green-700' : 'bg-blue-50 text-blue-600' }}">
                                        {{ $isConfigured ? 'OVERRIDDEN' : 'AUTO-GENERATED' }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-800 mb-1 line-clamp-1">{{ $program->title }}</h3>
                                <p class="text-xs text-gray-400 mb-4 uppercase tracking-wide">Program Page</p>

                                @if($isConfigured)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $meta->description }}</p>
                                    <div class="text-xs text-gray-400 mb-6">
                                        Customized: {{ $meta->updated_at->diffForHumans() }}
                                    </div>
                                @else
                                    <div class="bg-gray-50 rounded p-3 mb-6">
                                        <p class="text-xs text-gray-500 italic line-clamp-2">
                                            "{{ Str::limit($program->description, 100) }}"
                                        </p>
                                    </div>
                                @endif

                                <div>
                                    @if($isConfigured)
                                        <a href="{{ route('admin.seo-meta.edit', $meta->id) }}"
                                            class="block w-full text-center px-4 py-2 bg-brand-purple text-white font-bold rounded-lg hover:bg-brand-pink transition-colors">
                                            <i class="fas fa-edit mr-2"></i>Edit Override
                                        </a>
                                    @else
                                        <a href="{{ route('admin.seo-meta.create', ['page' => $key, 'item_id' => $program->id, 'route_name' => 'programs.show']) }}"
                                            class="block w-full text-center px-4 py-2 border-2 border-brand-purple text-brand-purple font-bold rounded-lg hover:bg-brand-purple hover:text-white transition-colors">
                                            <i class="fas fa-magic mr-2"></i>Override
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Blog Posts Section -->
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Blog Posts (Dynamic)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($blogPosts as $post)
                        @php
                            $key = 'blog:' . $post->id;
                            $meta = $seoMeta[$key] ?? null;
                            $isConfigured = !is_null($meta);
                        @endphp
                        <div
                            class="bg-white rounded-2xl shadow-sm overflow-hidden border {{ $isConfigured ? 'border-green-200' : 'border-orange-100' }} hover:shadow-md transition-all">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div
                                        class="p-3 {{ $isConfigured ? 'bg-green-100 text-green-600' : 'bg-orange-50 text-orange-500' }} rounded-lg">
                                        <i class="fas fa-pen-nib"></i>
                                    </div>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold {{ $isConfigured ? 'bg-green-100 text-green-700' : 'bg-orange-50 text-orange-600' }}">
                                        {{ $isConfigured ? 'OVERRIDDEN' : 'AUTO-GENERATED' }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-800 mb-1 line-clamp-1">{{ $post->title }}</h3>
                                <p class="text-xs text-gray-400 mb-4 uppercase tracking-wide">Blog Post</p>

                                @if($isConfigured)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $meta->description }}</p>
                                    <div class="text-xs text-gray-400 mb-6">
                                        Customized: {{ $meta->updated_at->diffForHumans() }}
                                    </div>
                                @else
                                    <div class="bg-gray-50 rounded p-3 mb-6">
                                        <p class="text-xs text-gray-500 italic line-clamp-2">
                                            "{{ Str::limit(strip_tags($post->content), 100) }}"
                                        </p>
                                    </div>
                                @endif

                                <div>
                                    @if($isConfigured)
                                        <a href="{{ route('admin.seo-meta.edit', $meta->id) }}"
                                            class="block w-full text-center px-4 py-2 bg-brand-purple text-white font-bold rounded-lg hover:bg-brand-pink transition-colors">
                                            <i class="fas fa-edit mr-2"></i>Edit Override
                                        </a>
                                    @else
                                        <a href="{{ route('admin.seo-meta.create', ['page' => $key]) }}"
                                            class="block w-full text-center px-4 py-2 border-2 border-brand-purple text-brand-purple font-bold rounded-lg hover:bg-brand-purple hover:text-white transition-colors">
                                            <i class="fas fa-magic mr-2"></i>Override
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection