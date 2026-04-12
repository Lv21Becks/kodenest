@extends('layouts.public')

@section('title', $post->title . ' — KodeNest Blog')
@section('meta_description', Str::limit(strip_tags($post->content), 160))

@section('content')
    {{-- Hero Background --}}
    <div class="relative">
        <div class="absolute top-0 left-0 w-full h-[56vh] -z-10 overflow-hidden">
            @if($post->photo_url)
                <img src="{{ $post->photo_url }}" alt="{{ $post->title }}"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 via-gray-900/50 to-gray-50"></div>
            @else
                <div class="w-full h-full bg-gradient-to-br from-gray-900 via-orange-950 to-orange-800"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-50"></div>
            @endif
        </div>

        {{-- Post Header --}}
        <article class="max-w-3xl mx-auto px-6 pt-40 pb-24">
            <header class="text-center mb-12">
                @if($post->category)
                    <span class="inline-block bg-orange-500 text-white px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-6 shadow-md">
                        {{ $post->category }}
                    </span>
                @endif

                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-6 leading-tight drop-shadow-lg">
                    {{ $post->title }}
                </h1>

                <div class="flex flex-wrap items-center justify-center gap-5 text-sm text-gray-300">
                    <div class="flex items-center gap-2">
                        <i class="far fa-calendar-alt text-orange-400"></i>
                        <span>{{ $post->published_at ? $post->published_at->format('F d, Y') : now()->format('F d, Y') }}</span>
                    </div>
                    @if($post->read_time)
                        <span class="text-gray-600">·</span>
                        <div class="flex items-center gap-2">
                            <i class="far fa-clock text-orange-400"></i>
                            <span>{{ $post->read_time }} min read</span>
                        </div>
                    @endif
                    @if($post->author)
                        <span class="text-gray-600">·</span>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-pen-nib text-orange-400"></i>
                            <span>{{ $post->author }}</span>
                        </div>
                    @endif
                </div>
            </header>

            {{-- Post Content Card --}}
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-12 prose prose-lg prose-headings:font-black prose-headings:text-gray-900 prose-a:text-orange-600 prose-a:no-underline hover:prose-a:underline prose-strong:text-gray-900 max-w-none">
                {!! $post->content !!}
            </div>

            {{-- Footer: Back link + Social Share --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-t border-gray-200 pt-8 mt-4">
                <a href="{{ route('blog') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-orange-600 transition-colors group bg-gray-50 hover:bg-orange-50 px-4 py-2.5 rounded-xl">
                    <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    Back to Blog
                </a>

                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Share</span>
                    <div class="flex items-center gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                            target="_blank"
                            title="Share on Facebook"
                            class="w-9 h-9 rounded-full bg-gray-100 hover:bg-blue-600 text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                            target="_blank"
                            title="Share on X"
                            class="w-9 h-9 rounded-full bg-gray-100 hover:bg-black text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}"
                            target="_blank"
                            title="Share on LinkedIn"
                            class="w-9 h-9 rounded-full bg-gray-100 hover:bg-blue-700 text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}"
                            target="_blank"
                            title="Share on WhatsApp"
                            class="w-9 h-9 rounded-full bg-gray-100 hover:bg-green-500 text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.instagram.com/"
                            target="_blank"
                            title="Share on Instagram"
                            class="w-9 h-9 rounded-full bg-gray-100 hover:bg-gradient-to-br hover:from-purple-600 hover:via-pink-500 hover:to-orange-400 text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>

    {{-- Newsletter CTA --}}
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="relative bg-gray-900 rounded-2xl p-10 md:p-14 text-center overflow-hidden">
            {{-- Decorative blobs --}}
            <div class="absolute -top-10 -left-10 w-48 h-48 rounded-full bg-orange-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -right-10 w-48 h-48 rounded-full bg-orange-600/20 blur-3xl pointer-events-none"></div>

            <span class="inline-block bg-orange-500/20 text-orange-400 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-4">Newsletter</span>
            <h3 class="text-2xl md:text-3xl font-black text-white mb-3">Enjoyed this article?</h3>
            <p class="text-gray-400 mb-8 max-w-lg mx-auto">Get the latest tech insights, career tips, and KodeNest news delivered straight to your inbox.</p>

            <form id="newsletterForm" class="max-w-xl mx-auto flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="Your email address" required
                    class="flex-1 px-5 py-3.5 rounded-xl bg-white/10 text-white placeholder-gray-400 border border-white/10 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow text-sm">
                <button type="submit"
                    class="px-6 py-3.5 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl transition-colors text-sm whitespace-nowrap shadow-lg shadow-orange-500/30">
                    Subscribe Free
                </button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.getElementById('newsletterForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('button');
        const orig = btn.innerText;
        btn.innerText = 'Subscribing...';
        btn.disabled = true;

        fetch("{{ route('newsletter.subscribe') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email: this.querySelector('input').value })
        })
        .then(r => r.json())
        .then(data => {
            alert(data.message || 'Thank you for subscribing!');
            this.reset();
        })
        .catch(() => alert('Something went wrong. Please try again.'))
        .finally(() => { btn.innerText = orig; btn.disabled = false; });
    });
</script>
@endpush