@extends('layouts.admin')

@section('title', 'SEO Meta')

@section('content')

    <div class="max-w-7xl mx-auto mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">SEO Meta Management</h1>
            <p class="text-gray-500 mt-1">Configure search engine metadata for static pages and dynamic content.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="space-y-12">

            <!-- Static Pages Section -->
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center text-orange-600 ring-1 ring-inset ring-orange-500/20">
                        <i class="fas fa-columns"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Static Pages</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($staticPages as $page)
                        @php
                            $meta = $seoMeta[$page] ?? null;
                            $isConfigured = !is_null($meta);
                        @endphp
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col hover:shadow-md transition-shadow">
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-10 h-10 {{ $isConfigured ? 'bg-green-50 text-green-600 ring-green-500/20' : 'bg-gray-50 text-gray-500 ring-gray-500/10' }} rounded-lg flex items-center justify-center ring-1 ring-inset shrink-0">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    @if($isConfigured)
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                            Customized
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            Default
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-2 capitalize">{{ $page }} Page</h3>

                                @if($isConfigured)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-1">{{ $meta->description }}</p>
                                    <div class="text-xs text-gray-400 font-medium mb-6">
                                        Updated: {{ $meta->updated_at->diffForHumans() }}
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 mb-6 italic flex-1">Using system defaults.</p>
                                @endif

                                <div>
                                    @if($isConfigured)
                                        <a href="{{ route('admin.seo-meta.edit', $meta->id) }}"
                                            class="flex w-full items-center justify-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors border border-gray-300 shadow-sm text-sm">
                                            <i class="fas fa-edit"></i> Edit Metadata
                                        </a>
                                    @else
                                        <a href="{{ route('admin.seo-meta.create', ['page' => $page]) }}"
                                            class="flex w-full items-center justify-center gap-2 px-4 py-2 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 transition-colors shadow-sm text-sm">
                                            <i class="fas fa-plus"></i> Configure
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
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 ring-1 ring-inset ring-blue-500/20">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Programs (Dynamic)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($programs as $program)
                        @php
                            $key = 'program:' . $program->slug;
                            $meta = $seoMeta[$key] ?? null;
                            $isConfigured = !is_null($meta);
                        @endphp
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col hover:shadow-md transition-shadow">
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-10 h-10 {{ $isConfigured ? 'bg-green-50 text-green-600 ring-green-500/20' : 'bg-blue-50 text-blue-500 ring-blue-500/20' }} rounded-lg flex items-center justify-center ring-1 ring-inset shrink-0">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    @if($isConfigured)
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                            Overridden
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">
                                            Auto-Generated
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1" title="{{ $program->title }}">{{ $program->title }}</h3>
                                <p class="text-xs text-gray-400 mb-4 uppercase tracking-wide font-medium">Program Page</p>

                                @if($isConfigured)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-1">{{ $meta->description }}</p>
                                    <div class="text-xs text-gray-400 font-medium mb-6">
                                        Customized: {{ $meta->updated_at->diffForHumans() }}
                                    </div>
                                @else
                                    <div class="bg-gray-50 rounded-lg p-3 mb-6 flex-1 ring-1 ring-inset ring-gray-200">
                                        <p class="text-sm text-gray-500 italic line-clamp-2">
                                            "{{ Str::limit($program->description, 100) }}"
                                        </p>
                                    </div>
                                    <div class="mb-2"></div>
                                @endif

                                <div>
                                    @if($isConfigured)
                                        <a href="{{ route('admin.seo-meta.edit', $meta->id) }}"
                                            class="flex w-full items-center justify-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors border border-gray-300 shadow-sm text-sm">
                                            <i class="fas fa-edit"></i> Edit Override
                                        </a>
                                    @else
                                        <a href="{{ route('admin.seo-meta.create', ['page' => $key, 'item_id' => $program->id, 'route_name' => 'programs.show']) }}"
                                            class="flex w-full items-center justify-center gap-2 px-4 py-2 bg-white text-orange-600 font-semibold rounded-lg hover:bg-orange-50 transition-colors border border-orange-200 shadow-sm text-sm">
                                            <i class="fas fa-magic"></i> Override
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
                    <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600 ring-1 ring-inset ring-purple-500/20">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Blog Posts (Dynamic)</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($blogPosts as $post)
                        @php
                            $key = 'blog:' . $post->id;
                            $meta = $seoMeta[$key] ?? null;
                            $isConfigured = !is_null($meta);
                        @endphp
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col hover:shadow-md transition-shadow">
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-10 h-10 {{ $isConfigured ? 'bg-green-50 text-green-600 ring-green-500/20' : 'bg-purple-50 text-purple-600 ring-purple-500/20' }} rounded-lg flex items-center justify-center ring-1 ring-inset shrink-0">
                                        <i class="fas fa-pen-nib"></i>
                                    </div>
                                    @if($isConfigured)
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                            Overridden
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-600/20">
                                            Auto-Generated
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1" title="{{ $post->title }}">{{ $post->title }}</h3>
                                <p class="text-xs text-gray-400 mb-4 uppercase tracking-wide font-medium">Blog Post</p>

                                @if($isConfigured)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-1">{{ $meta->description }}</p>
                                    <div class="text-xs text-gray-400 font-medium mb-6">
                                        Customized: {{ $meta->updated_at->diffForHumans() }}
                                    </div>
                                @else
                                    <div class="bg-gray-50 rounded-lg p-3 mb-6 flex-1 ring-1 ring-inset ring-gray-200">
                                        <p class="text-sm text-gray-500 italic line-clamp-2">
                                            "{{ Str::limit(strip_tags($post->content), 100) }}"
                                        </p>
                                    </div>
                                    <div class="mb-2"></div>
                                @endif

                                <div>
                                    @if($isConfigured)
                                        <a href="{{ route('admin.seo-meta.edit', $meta->id) }}"
                                            class="flex w-full items-center justify-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors border border-gray-300 shadow-sm text-sm">
                                            <i class="fas fa-edit"></i> Edit Override
                                        </a>
                                    @else
                                        <a href="{{ route('admin.seo-meta.create', ['page' => $key]) }}"
                                            class="flex w-full items-center justify-center gap-2 px-4 py-2 bg-white text-orange-600 font-semibold rounded-lg hover:bg-orange-50 transition-colors border border-orange-200 shadow-sm text-sm">
                                            <i class="fas fa-magic"></i> Override
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