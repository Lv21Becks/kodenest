@extends('layouts.public')

@section('content')
    {{-- Hero/Header Section --}}
    <div class="bg-gray-900 absolute top-0 w-full h-[50vh] -z-10">
        @if($post->featured_image)
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                class="w-full h-full object-cover opacity-30">
        @else
            <div class="w-full h-full bg-gradient-to-br from-brand-purple via-pink-600 to-orange-500 opacity-80"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-gray-50 via-transparent to-transparent"></div>
    </div>

    <article class="max-w-4xl mx-auto px-6 pt-48 pb-24">
        {{-- Post Header --}}
        <header class="text-center mb-16">
            @if($post->category)
                <span class="inline-block bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-bold mb-6 shadow-lg">
                    {{ $post->category }}
                </span>
            @endif
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 leading-tight">{{ $post->title }}</h1>

            <div class="flex flex-wrap items-center justify-center gap-6 text-gray-600">
                <div class="flex items-center gap-2">
                    <span class="bg-gray-200 p-2 rounded-full">📅</span>
                    <span>{{ $post->published_at ? $post->published_at->format('F d, Y') : now()->format('F d, Y') }}</span>
                </div>
                @if($post->read_time)
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-200 p-2 rounded-full">⏱️</span>
                        <span>{{ $post->read_time }} min read</span>
                    </div>
                @endif
                @if($post->author)
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-200 p-2 rounded-full">✍️</span>
                        <span>{{ $post->author }}</span>
                    </div>
                @endif
            </div>
        </header>

        {{-- Post Content --}}
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl mb-12 prose prose-lg prose-purple max-w-none">
            {!! $post->content !!}
        </div>

        {{-- Share / Tags / Navigation --}}
        <div class="border-t border-gray-200 pt-12 mt-12">
            <div class="flex justify-between items-center">
                <a href="{{ route('blog') }}"
                    class="inline-flex items-center gap-2 text-brand-purple font-bold hover:text-pink-600 transition-colors">
                    <span>←</span>
                    Back to Blog
                </a>

                {{-- Social Share (Placeholder) --}}
                <div class="flex gap-4">
                    <span class="text-gray-500 font-semibold">Share:</span>
                    <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors"><i
                            class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-sky-500 transition-colors"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-blue-700 transition-colors"><i
                            class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </article>

    {{-- Newsletter Section (Reusable) --}}
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="bg-gradient-to-r from-brand-purple to-pink-600 text-white rounded-2xl p-12 text-center shadow-lg">
            <h3 class="text-3xl font-bold mb-4">Enjoyed this article?</h3>
            <p class="text-xl mb-8 opacity-95">Subscribe to our newsletter for more tech insights and career advice.</p>
            <form id="newsletterForm" class="max-w-xl mx-auto flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Enter your email address" required
                    class="flex-1 px-6 py-4 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
                <button type="submit"
                    class="px-8 py-4 bg-white text-brand-purple font-semibold rounded-full hover:-translate-y-1 transition-transform duration-300">Subscribe</button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Newsletter form
        document.getElementById('newsletterForm')?.addEventListener('submit', function (e) {
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