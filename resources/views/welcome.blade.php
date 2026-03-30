@extends('layouts.public')

@section('body_class', 'overflow-x-hidden')

@section('content')
    {{-- 1. HERO SECTION: URGENCY & CONVERSION --}}
    <section class="relative min-h-screen flex items-center justify-center bg-white pt-24 pb-12 overflow-hidden">
        {{-- Background Blobs --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-[10%] -right-[10%] w-[50%] h-[50%] bg-orange-50 rounded-full blur-[120px] opacity-60">
            </div>
            <div class="absolute top-[20%] -lzeft-[10%] w-[40%] h-[40%] bg-purple-50 rounded-full blur-[120px] opacity-60">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            {{-- Badge --}}
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-orange-50 border border-orange-100 rounded-full text-orange-600 text-xs font-bold uppercase tracking-wider mb-8 animate-fade-in-up">
                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                New Cohort Starting Soon
            </div>

            {{-- Headline --}}
            <h1
                class="text-5xl md:text-7xl lg:text-8xl font-bold text-gray-900 mb-8 tracking-tight leading-[1.1] animate-fade-in-up delay-100">
                Turn your ambition <br> into a <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-orange-500">career.</span>
            </h1>

            {{-- Subhead --}}
            <p
                class="text-xl md:text-2xl text-gray-600 mb-12 max-w-3xl mx-auto font-light leading-relaxed animate-fade-in-up delay-200">
                Master the skills that matter. No fluff, just practical, hands-on tech training designed to get you hired.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center mb-16 animate-fade-in-up delay-300">
                <a href="#programs"
                    class="group relative px-10 py-5 bg-gray-900 text-white font-bold text-lg rounded-full shadow-2xl hover:scale-105 transition-all duration-300 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-3">
                        Explore Programs <i class="fas fa-arrow-down group-hover:translate-y-1 transition-transform"></i>
                    </span>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-gray-800 to-black opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </a>

                <a href="/contact"
                    class="px-10 py-5 bg-white border-2 border-gray-200 text-gray-700 font-bold text-lg rounded-full hover:border-orange-500 hover:text-orange-600 hover:shadow-lg transition-all duration-300">
                    Talk to an Advisor
                </a>
            </div>

            {{-- Social Proof --}}
            <div class="flex flex-col items-center animate-fade-in-up delay-400">
                <div class="flex items-center -space-x-4 mb-4">
                    {{-- Mock Avatars --}}
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-200"></div>
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-300"></div>
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-400"></div>
                    <div
                        class="w-10 h-10 rounded-full border-2 border-white bg-gray-900 text-white flex items-center justify-center text-xs font-bold">
                        +500</div>
                </div>
                <p class="text-sm text-gray-500 font-medium">
                    Trusted by <span class="text-gray-900 font-bold">500+ students</span> across Nigeria
                </p>
            </div>
        </div>
    </section>

    {{-- 2. WHO WE SERVE Section (Moved & Revamped) --}}
    <section class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Who is KodeNest for?</h2>
                <p class="text-lg text-gray-600">We’ve designed our programs to fit your stage in life.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Card 1: Students --}}
                <div
                    class="group bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 text-center border border-gray-100 hover:-translate-y-2 reveal delay-100">
                    <div
                        class="w-16 h-16 mx-auto mb-6 bg-orange-50 rounded-full flex items-center justify-center text-orange-600 text-2xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Students</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Recent graduates looking to replace theory with
                        job-ready practical skills.</p>
                </div>

                {{-- Card 2: Beginners --}}
                <div
                    class="group bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 text-center border border-gray-100 hover:-translate-y-2 reveal delay-200">
                    <div
                        class="w-16 h-16 mx-auto mb-6 bg-purple-50 rounded-full flex items-center justify-center text-purple-600 text-2xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Complete Beginners</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Starting from zero? We guide you step-by-step. No prior
                        code knowledge needed.</p>
                </div>

                {{-- Card 3: Professionals --}}
                <div
                    class="group bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 text-center border border-gray-100 hover:-translate-y-2 reveal delay-300">
                    <div
                        class="w-16 h-16 mx-auto mb-6 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 text-2xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Professionals</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Switching careers or upskilling? Get the edge you need
                        to move into tech.</p>
                </div>

                {{-- Card 4: Kids --}}
                <div
                    class="group bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 text-center border border-gray-100 hover:-translate-y-2 reveal delay-400">
                    <div
                        class="w-16 h-16 mx-auto mb-6 bg-pink-50 rounded-full flex items-center justify-center text-pink-600 text-2xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-child"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kids & Teens</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Young minds ready to build games, apps, and robots. The
                        future starts here.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. EMOTIONAL PROOF (Why Beginners Choose) --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="reveal-left">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        We don't just teach code.<br>
                        <span class="text-orange-600">We build confidence.</span>
                    </h2>
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                        At Kodenest, we offer a structured and accessible pathway into technology, equipping learners with
                        practical, industry- relevant skills. Register with us today and take the next step towards a
                        successful tech career.
                    </p>

                    <div class="space-y-8">
                        <div class="flex gap-5">
                            <div
                                class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 shadow-sm shrink-0">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Build Real Portfolio Projects</h3>
                                <p class="text-gray-500 mt-1">Leave with a GitHub profile that proves you can do the job.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div
                                class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 shadow-sm shrink-0">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Direct Mentorship</h3>
                                <p class="text-gray-500 mt-1">Get unstuck fast with guidance from experienced developers.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-5">
                            <div
                                class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 shadow-sm shrink-0">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Career Support</h3>
                                <p class="text-gray-500 mt-1">Interview prep, resume reviews, and industry connections.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Image --}}
                <div class="relative h-[600px] rounded-3xl overflow-hidden shadow-2xl reveal-right">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=2070&auto=format&fit=crop"
                        className="absolute inset-0 w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                        alt="Coding workshop" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-10 left-10 text-white max-w-xs">
                        <p class="font-bold text-xl">"I built my first app in week 4."</p>
                        <p class="text-sm opacity-80 mt-2">— Sarah, Frontend Student</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. PROGRAMS SECTION --}}
    <section class="py-24 bg-gray-50" id="programs">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20 max-w-3xl mx-auto reveal">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight">
                    Choose your path
                </h2>
                <p class="text-xl text-gray-600">
                    Expert-led courses designed to take you from beginner to pro.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $program)
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 flex flex-col hover:-translate-y-2 transition-transform duration-300 group">
                        {{-- Image Area (1/3) --}}
                        {{-- Image Area --}}
                        <div class="h-64 relative p-4 pb-0">
                            <div class="w-full h-full rounded-2xl overflow-hidden relative bg-gray-100 shadow-sm border border-gray-100">
                                @if($program->image_icon)
                                    <img src="{{ asset('storage/' . $program->image_icon) }}" alt="{{ $program->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        <i class="fas fa-image text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-3 left-3 flex gap-2">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm px-2.5 py-1 text-[10px] font-bold text-gray-900 rounded-full shadow-sm">
                                        Instructor Led
                                    </span>
                                    <span
                                        class="bg-orange-500/90 backdrop-blur-sm px-2.5 py-1 text-[10px] font-bold text-white rounded-full shadow-sm">
                                        Online / Physical
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Content Area --}}
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 group-hover:text-orange-600 transition-colors">
                                {{ $program->title }}
                            </h3>

                            <div class="space-y-4 mb-8 flex-grow border-t border-gray-100 pt-6">
                                {{-- Duration --}}
                                <div class="flex items-center text-gray-600">
                                    <div class="w-8 flex justify-center"><i class="far fa-clock text-orange-500"></i></div>
                                    <span class="font-medium text-sm ml-2">{{ $program->duration }}</span>
                                </div>
                                {{-- Lessons (Placeholder as per request context) --}}
                                <div class="flex items-center text-gray-600">
                                    <div class="w-8 flex justify-center"><i class="fas fa-book-open text-purple-600"></i></div>
                                    <span class="font-medium text-sm ml-2">20+ Lessons & Projects</span>
                                </div>

                            </div>

                            {{-- Enroll Button --}}
                            <a href="{{ route('programs.show', $program->slug) }}"
                                class="block w-full py-4 bg-gray-900 text-white font-bold text-center rounded-xl hover:bg-orange-600 transition-colors shadow-lg">
                                View Program Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-16 reveal">
                <a href="/programs"
                    class="inline-block px-10 py-4 bg-white border border-gray-200 text-gray-900 font-bold rounded-full hover:bg-gray-50 transition-colors">
                    View All Programs
                </a>
            </div>
        </div>
    </section>

    {{-- 5. NEW: B2B / SERVICES SECTION ("We Work For You") --}}
    <section class="py-24 bg-gradient-to-br from-orange-50 to-white text-gray-900 relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-40">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-orange-100 rounded-full blur-[150px]"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-purple-50 rounded-full blur-[150px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div
                        class="inline-block px-4 py-1 border border-orange-200 rounded-full text-orange-600 text-xs font-bold uppercase tracking-wider mb-6 bg-white">
                        Services & Development
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight text-gray-900">
                        Need a website or mobile app? <br> we build for you too.
                    </h2>
                    <p class="text-xl text-gray-600 mb-10 leading-relaxed font-light">
                        KodeNest isn't just a school. We are a team of expert developers. From corporate websites to complex
                        software solutions, we can bring your vision to life.
                    </p>

                    <div class="grid grid-cols-2 gap-6 mb-10">
                        <div
                            class="p-6 rounded-xl bg-white border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1">
                            <i class="fas fa-globe text-2xl text-orange-500 mb-4"></i>
                            <h4 class="font-bold text-lg text-gray-900">Websites</h4>
                        </div>
                        <div
                            class="p-6 rounded-xl bg-white border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1">
                            <i class="fas fa-mobile-alt text-2xl text-purple-600 mb-4"></i>
                            <h4 class="font-bold text-lg text-gray-900">Mobile Apps</h4>
                        </div>
                        <div
                            class="p-6 rounded-xl bg-white border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1">
                            <i class="fas fa-shopping-cart text-2xl text-pink-500 mb-4"></i>
                            <h4 class="font-bold text-lg text-gray-900">E-Commerce</h4>
                        </div>
                        <div
                            class="p-6 rounded-xl bg-white border border-gray-100 hover:shadow-lg transition-all hover:-translate-y-1">
                            <i class="fas fa-code text-2xl text-blue-500 mb-4"></i>
                            <h4 class="font-bold text-lg text-gray-900">Custom Software</h4>
                        </div>
                    </div>

                    <a href="/contact?service=true"
                        class="inline-block px-8 py-4 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-lg transition-colors shadow-lg shadow-orange-200">
                        Get a Quote
                    </a>
                </div>

                <div class="relative">
                    {{-- Minimalist Code/Tech visual --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-full blur-2xl -mr-10 -mt-10">
                        </div>

                        <div class="flex items-center gap-2 mb-6 border-b border-gray-100 pb-4">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        </div>
                        <div class="space-y-4 font-mono text-sm relative z-10">
                            <div class="text-purple-600">class <span class="text-orange-500">KodeNest</span> extends <span
                                    class="text-blue-500">Solution</span> {</div>
                            <div class="pl-4 text-gray-500">public function <span class="text-blue-600">build</span>($idea)
                                {</div>
                            <div class="pl-8 text-gray-400">// We turn complexity into clarity</div>
                            <div class="pl-8 text-green-600">return new Product($idea);</div>
                            <div class="pl-4 text-gray-500">}</div>
                            <div class="text-purple-600">}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. WALL OF LOVE (Testimonials) --}}
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-16 reveal">
                What people say about us
            </h2>

            <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
                @forelse($testimonials as $testimonial)
                    <div class="break-inside-avoid bg-gray-50 p-8 rounded-3xl reveal hover:shadow-lg transition-shadow">
                        <div class="text-orange-500 mb-4 text-sm">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-6 leading-relaxed">"{{ $testimonial->content }}"</p>
                        <div class="flex items-center gap-4">
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}"
                                    class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold">
                                    {{ substr($testimonial->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">{{ $testimonial->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $testimonial->position }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No testimonials yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 7. FINAL CTA --}}
    <section class="py-32 bg-gray-50 text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-8 tracking-tight">
                Stop waiting. <br> Start <span class="text-orange-600">building.</span>
            </h2>
            <p class="text-xl text-gray-600 mb-12">
                Join the next cohort of KodeNest students and change your future.
            </p>
            <a href="/enroll"
                class="inline-block px-12 py-6 bg-gray-900 text-white font-bold text-xl rounded-full shadow-2xl hover:scale-105 transition-transform">
                Apply Now - Start Your Journey
            </a>
            <p class="mt-6 text-sm text-gray-500">
                <i class="fas fa-lock text-gray-400 mr-1"></i> Secure your spot today.
            </p>
        </div>
    </section>
@endsection