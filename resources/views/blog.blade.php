@extends('layouts.public')

@section('title', 'Blog & Resources - KodeNest ICT Academy')

@section('content')
@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-24 pb-16 bg-white overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-orange-50 rounded-full blur-[100px] opacity-60"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-purple-50 rounded-full blur-[100px] opacity-60">
        </div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 tracking-tight">
                Insights, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-pink-600">
                    Resources & News.
                </span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed font-light">
                Stay updated with the latest trends in tech, career advice, and KodeNest announcements.
            </p>
        </div>
    </section>

    {{-- Blog Feed Section --}}
    <section class="py-20 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Filter Tabs (Centered) --}}
            <div class="flex justify-center flex-wrap gap-3 mb-16">
                <button data-filter="all"
                    class="filter-btn px-6 py-2 bg-gray-900 text-white rounded-full font-bold text-sm hover:bg-gray-800 transition-colors shadow-lg shadow-gray-200">
                    All Posts
                </button>
                <button data-filter="Career Advice"
                    class="filter-btn px-6 py-2 bg-white text-gray-600 border border-gray-200 rounded-full font-bold text-sm hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    Career Advice
                </button>
                <button data-filter="Tech Articles"
                    class="filter-btn px-6 py-2 bg-white text-gray-600 border border-gray-200 rounded-full font-bold text-sm hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    Tech Articles
                </button>
                <button data-filter="Announcements"
                    class="filter-btn px-6 py-2 bg-white text-gray-600 border border-gray-200 rounded-full font-bold text-sm hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    Announcements
                </button>
                <button data-filter="Student Highlights"
                    class="filter-btn px-6 py-2 bg-white text-gray-600 border border-gray-200 rounded-full font-bold text-sm hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    Student Highlights
                </button>
            </div>

            {{-- Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <div data-category="{{ $post->category }}"
                        class="blog-post-card group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:-translate-y-1 hover:shadow-md transition-all duration-300 flex flex-col h-full">

                        {{-- Image --}}
                        <div class="h-48 relative overflow-hidden bg-gray-100">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300">
                                    <i class="far fa-newspaper"></i>
                                </div>
                            @endif
                            @if($post->category)
                                <span
                                    class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-sm text-xs font-bold text-gray-900 rounded-full shadow-sm">
                                    {{ $post->category }}
                                </span>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-8 flex flex-col flex-grow">
                            <div
                                class="flex items-center gap-3 text-xs text-gray-500 mb-4 font-medium uppercase tracking-wider">
                                <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : now()->format('M d, Y') }}</span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span>{{ $post->read_time ?? '5' }} min read</span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">
                                {{ $post->title }}
                            </h3>

                            <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                                {{ Str::limit($post->excerpt, 100) }}
                            </p>

                            <a href="{{ route('blog.show', $post->slug) }}"
                                class="inline-flex items-center font-bold text-sm text-gray-900 group-hover:text-orange-600 transition-colors">
                                Read Article <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div
                            class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-gray-400">
                            <i class="far fa-newspaper text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">No articles found</h3>
                        <p class="text-gray-500">Check back later for new content.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Resources Section --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Free Learning Resources</h2>
                <p class="text-gray-500">Tools to help you accelerate your growth.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="#"
                    class="group p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:bg-orange-50 hover:border-orange-100 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-orange-500 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-orange-600">E-Books</h3>
                    <p class="text-sm text-gray-500">Comprehensive guides on coding and design.</p>
                </a>

                <a href="#"
                    class="group p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:bg-purple-50 hover:border-purple-100 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-purple-600 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-play"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-purple-600">Video Tutorials</h3>
                    <p class="text-sm text-gray-500">Watch and learn at your own pace.</p>
                </a>

                <a href="#"
                    class="group p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:bg-pink-50 hover:border-pink-100 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-pink-500 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-pink-600">Career Kits</h3>
                    <p class="text-sm text-gray-500">Resume templates and interview prep.</p>
                </a>

                <a href="#"
                    class="group p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:bg-blue-50 hover:border-blue-100 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-500 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-blue-600">Community</h3>
                    <p class="text-sm text-gray-500">Join our Discord server.</p>
                </a>
            </div>
        </div>
    </section>

    {{-- Newsletter Section --}}
    <section class="py-24 bg-gray-900 text-white text-center">
        <div class="max-w-2xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-4">Stay Weekly Updated</h2>
            <p class="text-gray-400 mb-10">Get the latest tech news and career tips delivered to your inbox. No spam, ever.
            </p>

            <form id="newsletterForm" class="flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="Enter your email address" required
                    class="flex-1 px-6 py-4 rounded-full bg-gray-800 text-white border border-gray-700 focus:outline-none focus:border-orange-500 transition-colors">
                <button type="submit"
                    class="px-8 py-4 bg-white text-gray-900 font-bold rounded-full hover:bg-orange-500 hover:text-white transition-all duration-300">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const posts = document.querySelectorAll('.blog-post-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                // Update active state
                filterBtns.forEach(b => {
                    b.classList.remove('bg-gray-900', 'text-white', 'shadow-lg', 'shadow-gray-200');
                    b.classList.add('bg-white', 'text-gray-600');
                });
                this.classList.remove('bg-white', 'text-gray-600');
                this.classList.add('bg-gray-900', 'text-white', 'shadow-lg', 'shadow-gray-200');

                // Filter posts
                const filterValue = this.getAttribute('data-filter');

                posts.forEach(post => {
                    const postCategory = post.getAttribute('data-category');

                    if (filterValue === 'all' || postCategory === filterValue) {
                        post.classList.remove('hidden');
                        post.classList.add('block');
                        // Add animation class if you want
                        post.classList.add('animate-[fadeIn_0.5s_ease-out]');
                    } else {
                        post.classList.remove('block');
                        post.classList.add('hidden');
                    }
                });
            });
        });

        // Newsletter form
        document.getElementById('newsletterForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            const email = form.querySelector('input[type="email"]').value;
            const btn = form.querySelector('button');
            const originalText = btn.innerText;

            btn.innerText = 'Subscribing...';
            btn.disabled = true;

            fetch("{{ route('newsletter.subscribe') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        form.reset();
                    } else if (data.errors) {
                        alert(Object.values(data.errors).flat().join('\n'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong. Please try again.');
                })
                .finally(() => {
                    btn.innerText = originalText;
                    btn.disabled = false;
                });
        });
    </script>
@endpush