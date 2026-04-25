@extends('layouts.public')

@section('title', $post->title . ' — KodeNest Blog')
@section('meta_description', Str::limit(strip_tags($post->content ?: $post->excerpt), 160))

@push('styles')
<style>
    /* Reading progress bar */
    #reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(90deg, #f97316, #ea580c);
        z-index: 9999;
        transition: width 0.1s linear;
        width: 0%;
    }

    /* Prose / article content styles */
    .article-body h2 {
        font-size: 1.55rem;
        font-weight: 900;
        color: #111827;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #fed7aa;
        line-height: 1.3;
    }
    .article-body h3 {
        font-size: 1.2rem;
        font-weight: 800;
        color: #1f2937;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
    }
    .article-body p {
        color: #374151;
        font-size: 1.065rem;
        line-height: 1.85;
        margin-bottom: 1.4rem;
    }
    .article-body ul, .article-body ol {
        margin: 1.2rem 0 1.6rem 1.5rem;
        color: #374151;
        font-size: 1.065rem;
        line-height: 1.85;
    }
    .article-body ul li { list-style-type: disc; margin-bottom: 0.5rem; }
    .article-body ol li { list-style-type: decimal; margin-bottom: 0.5rem; }
    .article-body a {
        color: #ea580c;
        font-weight: 600;
        text-decoration: none;
        border-bottom: 1px solid #fed7aa;
        transition: color 0.2s, border-color 0.2s;
    }
    .article-body a:hover { color: #c2410c; border-color: #ea580c; }
    .article-body strong { color: #111827; font-weight: 700; }
    .article-body blockquote {
        border-left: 4px solid #f97316;
        background: #fff7ed;
        padding: 1.2rem 1.5rem;
        margin: 2rem 0;
        border-radius: 0 0.75rem 0.75rem 0;
    }
    .article-body blockquote p {
        color: #9a3412;
        font-style: italic;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0;
    }
    .article-body .callout {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        border: 1px solid #fed7aa;
        border-radius: 1rem;
        padding: 1.25rem 1.5rem;
        margin: 2rem 0;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }
    .article-body .callout-icon {
        flex-shrink: 0;
        width: 2rem;
        height: 2rem;
        background: #f97316;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
        margin-top: 0.1rem;
    }
    .article-body .callout p { margin-bottom: 0; color: #7c2d12; }
    .article-body .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
        margin: 2rem 0;
    }
    .article-body .stat-card {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1.25rem;
        text-align: center;
    }
    .article-body .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 900;
        color: #f97316;
        line-height: 1;
    }
    .article-body .stat-card .stat-label {
        font-size: 0.8rem;
        color: #6b7280;
        font-weight: 600;
        margin-top: 0.25rem;
    }
    .article-body .step-card {
        display: flex;
        gap: 1.25rem;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        padding: 1.25rem;
        background: #f9fafb;
        border-radius: 1rem;
        border: 1px solid #e5e7eb;
    }
    .article-body .step-number {
        flex-shrink: 0;
        width: 2.5rem;
        height: 2.5rem;
        background: #f97316;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 1rem;
    }
    .article-body .step-card p { margin-bottom: 0; }
    .toc-link { transition: color 0.2s, padding-left 0.2s; }
    .toc-link:hover { color: #ea580c; padding-left: 4px; }
    .toc-link.active { color: #ea580c; font-weight: 700; }
</style>
@endpush

@section('content')

{{-- Reading progress bar --}}
<div id="reading-progress"></div>

<div class="relative bg-gray-50 min-h-screen">

    {{-- ── HERO ──────────────────────────────────────────────── --}}
    <div class="relative w-full h-[52vh] min-h-[380px] overflow-hidden">
        @if($post->photo_url)
            <img src="{{ $post->photo_url }}" alt="{{ $post->title }}"
                class="w-full h-full object-cover scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/80 via-gray-900/60 to-gray-50"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-orange-950 to-orange-900"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-50"></div>
        @endif

        {{-- Hero content --}}
        <div class="absolute inset-0 flex flex-col items-center justify-center px-6 text-center pt-16">
            @if($post->category)
                <span class="inline-flex items-center gap-2 bg-orange-500 text-white px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-5 shadow-lg">
                    <i class="fas fa-tag text-[10px]"></i> {{ $post->category }}
                </span>
            @endif

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white max-w-4xl leading-tight drop-shadow-xl mb-6">
                {{ $post->title }}
            </h1>

            <div class="flex flex-wrap items-center justify-center gap-5 text-sm text-gray-300">
                <div class="flex items-center gap-2">
                    <i class="far fa-calendar-alt text-orange-400"></i>
                    <span>{{ $post->published_at ? $post->published_at->format('F d, Y') : now()->format('F d, Y') }}</span>
                </div>
                @if($post->read_time)
                    <span class="text-gray-500">·</span>
                    <div class="flex items-center gap-2">
                        <i class="far fa-clock text-orange-400"></i>
                        <span>{{ $post->read_time }} min read</span>
                    </div>
                @endif
                @if($post->author)
                    <span class="text-gray-500">·</span>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-pen-nib text-orange-400"></i>
                        <span>{{ $post->author }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ── BODY LAYOUT ────────────────────────────────────────── --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 pb-24 relative z-10">
        <div class="flex gap-10 items-start">

            {{-- ── SIDEBAR (hidden on mobile) ──────────────────── --}}
            <aside class="hidden xl:block w-64 flex-shrink-0 sticky top-24 self-start">
                {{-- Table of Contents --}}
                @if($post->content && strlen(strip_tags($post->content)) > 200)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Contents</p>
                    <nav id="toc" class="space-y-1.5">
                        {{-- Populated by JS --}}
                    </nav>
                </div>
                @endif

                {{-- Category badge --}}
                @if($post->category)
                <div class="bg-orange-50 border border-orange-100 rounded-2xl p-6 mb-6">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Category</p>
                    <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 bg-orange-500 text-white px-4 py-2 rounded-full text-xs font-bold hover:bg-orange-600 transition-colors">
                        <i class="fas fa-tag text-[10px]"></i> {{ $post->category }}
                    </a>
                </div>
                @endif

                {{-- Reading time --}}
                @if($post->read_time)
                <div class="bg-white border border-gray-100 rounded-2xl p-6">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Read time</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center">
                            <i class="far fa-clock text-orange-500"></i>
                        </div>
                        <span class="text-2xl font-black text-gray-900">{{ $post->read_time }}<span class="text-sm font-semibold text-gray-400 ml-1">min</span></span>
                    </div>
                    <div class="mt-3 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div id="sidebar-progress" class="h-full bg-gradient-to-r from-orange-400 to-orange-600 rounded-full transition-all duration-200" style="width:0%"></div>
                    </div>
                </div>
                @endif
            </aside>

            {{-- ── MAIN ARTICLE ─────────────────────────────────── --}}
            <main class="flex-1 min-w-0">

                {{-- Excerpt / intro card --}}
                @if($post->excerpt)
                <div class="bg-white rounded-2xl shadow-sm border-l-4 border-orange-500 p-6 sm:p-8 mb-8 text-gray-600 text-lg leading-relaxed font-medium italic">
                    {!! $post->excerpt !!}
                </div>
                @endif

                {{-- The actual content --}}
                <div id="article-content" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7 sm:p-12 mb-8 article-body">
                    @if($post->content && trim(strip_tags($post->content)) !== '' && $post->content !== 'Full content here...')
                        {!! $post->content !!}
                    @else
                        <div class="text-center py-16 text-gray-400">
                            <i class="fas fa-file-alt text-5xl mb-4 block"></i>
                            <p class="font-medium">Full article content coming soon.</p>
                        </div>
                    @endif
                </div>

                {{-- Tags --}}
                @if($post->category)
                <div class="flex flex-wrap items-center gap-2 mb-8">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tagged:</span>
                    <a href="{{ route('blog') }}" class="px-3 py-1 bg-gray-100 hover:bg-orange-100 hover:text-orange-700 text-gray-600 text-xs font-semibold rounded-full transition-colors">{{ $post->category }}</a>
                    <a href="{{ route('blog') }}" class="px-3 py-1 bg-gray-100 hover:bg-orange-100 hover:text-orange-700 text-gray-600 text-xs font-semibold rounded-full transition-colors">KodeNest</a>
                    <a href="{{ route('blog') }}" class="px-3 py-1 bg-gray-100 hover:bg-orange-100 hover:text-orange-700 text-gray-600 text-xs font-semibold rounded-full transition-colors">Tech Nigeria</a>
                </div>
                @endif

                {{-- Share + Back --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white border border-gray-100 rounded-2xl p-5 sm:p-6 shadow-sm">
                    <a href="{{ route('blog') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-orange-600 transition-colors group bg-gray-50 hover:bg-orange-50 px-4 py-2.5 rounded-xl">
                        <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                        Back to Blog
                    </a>

                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Share</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-blue-600 text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-black text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-blue-700 text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-green-500 text-gray-500 hover:text-white transition-all flex items-center justify-center text-sm"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

            </main>
        </div>

        {{-- ── NEWSLETTER CTA ──────────────────────────────────── --}}
        <div class="mt-16 relative bg-gray-900 rounded-2xl p-10 md:p-14 text-center overflow-hidden">
            <div class="absolute -top-10 -left-10 w-56 h-56 rounded-full bg-orange-500/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -right-10 w-56 h-56 rounded-full bg-orange-600/20 blur-3xl pointer-events-none"></div>
            <div class="relative z-10">
                <span class="inline-block bg-orange-500/20 text-orange-400 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-4">Newsletter</span>
                <h3 class="text-2xl md:text-3xl font-black text-white mb-3">Enjoyed this article?</h3>
                <p class="text-gray-400 mb-8 max-w-lg mx-auto">Get the latest tech insights, career tips, and KodeNest news delivered straight to your inbox.</p>
                <form id="newsletterForm" class="max-w-xl mx-auto flex flex-col sm:flex-row gap-3">
                    <input type="email" placeholder="Your email address" required
                        class="flex-1 px-5 py-3.5 rounded-xl bg-white/10 text-white placeholder-gray-400 border border-white/10 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-shadow text-sm">
                    <button type="submit" class="px-6 py-3.5 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl transition-colors text-sm whitespace-nowrap shadow-lg shadow-orange-500/30">
                        Subscribe Free
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Reading progress bar
    const bar = document.getElementById('reading-progress');
    const sideBar = document.getElementById('sidebar-progress');
    const article = document.getElementById('article-content');
    window.addEventListener('scroll', () => {
        if (!article) return;
        const top = article.getBoundingClientRect().top + window.scrollY;
        const height = article.offsetHeight;
        const scrolled = window.scrollY + window.innerHeight - top;
        const pct = Math.min(100, Math.max(0, (scrolled / height) * 100));
        if (bar) bar.style.width = pct + '%';
        if (sideBar) sideBar.style.width = pct + '%';
    });

    // Generate Table of Contents from H2/H3 headings
    const toc = document.getElementById('toc');
    if (toc && article) {
        const headings = article.querySelectorAll('h2, h3');
        if (headings.length > 1) {
            headings.forEach((h, i) => {
                if (!h.id) h.id = 'heading-' + i;
                const link = document.createElement('a');
                link.href = '#' + h.id;
                link.textContent = h.textContent;
                link.className = 'toc-link block text-sm text-gray-500 hover:text-orange-600 leading-snug ' + (h.tagName === 'H3' ? 'pl-3 text-xs' : 'font-semibold');
                link.addEventListener('click', e => {
                    e.preventDefault();
                    document.getElementById(h.id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
                toc.appendChild(link);
            });
            // Highlight active on scroll
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    const link = toc.querySelector(`[href="#${entry.target.id}"]`);
                    if (link) link.classList.toggle('active', entry.isIntersecting);
                });
            }, { rootMargin: '0px 0px -60% 0px', threshold: 0 });
            headings.forEach(h => observer.observe(h));
        } else {
            toc.closest('.bg-white')?.remove();
        }
    }

    // Newsletter
    document.getElementById('newsletterForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('button');
        const orig = btn.innerText;
        btn.innerText = 'Subscribing...';
        btn.disabled = true;
        fetch("{{ route('newsletter.subscribe') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ email: this.querySelector('input').value })
        })
        .then(r => r.json())
        .then(data => { alert(data.message || 'Thank you for subscribing!'); this.reset(); })
        .catch(() => alert('Something went wrong. Please try again.'))
        .finally(() => { btn.innerText = orig; btn.disabled = false; });
    });
</script>
@endpush