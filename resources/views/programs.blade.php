@extends('layouts.public')

@section('title', 'Programs - KodeNest ICT Academy')

@section('content')
    {{-- Hero --}}
    <section class="relative pt-28 pb-20 bg-white overflow-hidden text-center">
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] bg-orange-50 rounded-full blur-[120px] opacity-60"></div>
            <div class="absolute -bottom-[10%] right-0 w-[40%] h-[40%] bg-orange-50/50 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-4xl mx-auto px-6 relative z-10 animate-fade-in-up">
            <span class="inline-block bg-orange-100 text-orange-600 text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-6">
                Our Programs
            </span>
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 tracking-tight">
                Master the Skills that <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-orange-500">Matter.</span>
            </h1>
            <p class="text-xl text-gray-500 leading-relaxed font-light max-w-2xl mx-auto">
                Comprehensive tech training designed to launch your career. From beginner to pro.
            </p>
            <div class="flex items-center justify-center gap-8 mt-10 text-sm text-gray-400 font-semibold">
                <div class="flex items-center gap-2"><i class="fas fa-certificate text-orange-500"></i> Industry Certified</div>
                <div class="flex items-center gap-2"><i class="fas fa-users text-orange-500"></i> Expert Mentors</div>
                <div class="flex items-center gap-2"><i class="fas fa-laptop text-orange-500"></i> Hands-on Projects</div>
            </div>
        </div>
    </section>

    {{-- Programs Grid --}}
    <section class="py-16 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($programs->isEmpty())
                    <div class="col-span-full text-center py-16">
                        <i class="fas fa-graduation-cap text-5xl text-gray-200 mb-4"></i>
                        <p class="text-gray-400 font-medium">Programs are being updated. Check back soon.</p>
                    </div>
                @endif

                @foreach($programs as $index => $program)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col
                        hover:-translate-y-2 hover:shadow-xl hover:border-orange-100 transition-all duration-300 group
                        opacity-0 animate-fade-in-up"
                        style="animation-delay: {{ $index * 100 }}ms; animation-fill-mode: forwards;">

                        {{-- Image Area --}}
                        <div class="h-56 relative p-4 pb-0">
                            <div class="w-full h-full rounded-2xl overflow-hidden relative bg-gray-100 shadow-sm">
                                @if($program->image_icon)
                                    <img src="{{ asset('storage/' . $program->image_icon) }}" alt="{{ $program->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-50 to-gray-100">
                                        <i class="fas fa-laptop-code text-5xl text-orange-300"></i>
                                    </div>
                                @endif

                                {{-- Overlay on hover --}}
                                <div class="absolute inset-0 bg-gray-900/0 group-hover:bg-gray-900/10 transition-colors duration-300 rounded-2xl"></div>

                                {{-- Badges --}}
                                <div class="absolute top-3 left-3 flex gap-2">
                                    <span class="bg-white/90 backdrop-blur-sm px-2.5 py-1 text-[10px] font-bold text-gray-900 rounded-full shadow-sm">
                                        Instructor Led
                                    </span>
                                    <span class="bg-orange-500/90 backdrop-blur-sm px-2.5 py-1 text-[10px] font-bold text-white rounded-full shadow-sm">
                                        Online / Physical
                                    </span>
                                </div>

                                @if($program->coming_soon ?? false)
                                    <div class="absolute inset-0 bg-gray-900/60 flex items-center justify-center rounded-2xl">
                                        <span class="bg-orange-500 text-white text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-lg animate-pulse">
                                            Coming Soon
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 group-hover:text-orange-600 transition-colors leading-snug">
                                {{ $program->title }}
                            </h3>

                            <div class="space-y-3 mb-6 flex-grow border-t border-gray-100 pt-4">
                                <div class="flex items-center text-gray-500 text-sm">
                                    <div class="w-7 flex justify-center flex-shrink-0">
                                        <i class="far fa-clock text-orange-500"></i>
                                    </div>
                                    <span class="font-medium ml-2">{{ $program->duration }}</span>
                                </div>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <div class="w-7 flex justify-center flex-shrink-0">
                                        <i class="fas fa-book-open text-orange-400"></i>
                                    </div>
                                    <span class="font-medium ml-2">20+ Lessons &amp; Projects</span>
                                </div>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <div class="w-7 flex justify-center flex-shrink-0">
                                        <i class="fas fa-certificate text-orange-400"></i>
                                    </div>
                                    <span class="font-medium ml-2">Certificate Included</span>
                                </div>
                            </div>

                            <a href="{{ route('programs.show', $program->slug) }}"
                                class="block w-full py-3.5 bg-gray-900 text-white font-bold text-center text-sm rounded-xl
                                hover:bg-orange-600 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 shadow-sm group-hover:bg-orange-600">
                                View Program Details
                                <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

                @if($programs->isNotEmpty())
                    {{-- Coming Soon teaser --}}
                    <div class="col-span-full mt-4 bg-white rounded-2xl border border-dashed border-orange-200 p-10 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 rounded-2xl bg-orange-50 flex items-center justify-center mb-4">
                            <i class="fas fa-rocket text-orange-500 text-2xl animate-bounce"></i>
                        </div>
                        <span class="inline-block bg-orange-100 text-orange-600 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-3">Coming Soon</span>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">More Programs on the Way</h3>
                        <p class="text-gray-500 text-sm max-w-md leading-relaxed">We're working hard to bring you new tech courses across design, development, and data. Stay tuned!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="relative py-24 bg-gray-900 text-center overflow-hidden">
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-orange-600/10 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-orange-500/10 rounded-full blur-[80px]"></div>
        </div>
        <div class="max-w-2xl mx-auto px-6 relative z-10">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-orange-500/10 border border-orange-500/20 rounded-2xl mb-6">
                <i class="fas fa-comments text-orange-400 text-xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-white mb-4">Not sure where to start?</h2>
            <p class="text-gray-400 mb-8 leading-relaxed">Book a free consultation session with our advisors and find the right path for your career goals.</p>
            <a href="/contact"
                class="inline-flex items-center gap-2 px-10 py-4 bg-orange-600 hover:bg-orange-500 text-white font-bold rounded-full transition-all duration-200 hover:shadow-xl hover:shadow-orange-500/20 hover:-translate-y-0.5">
                Talk to an Advisor <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
    </section>
@endsection