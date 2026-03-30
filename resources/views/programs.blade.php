@extends('layouts.public')

@section('title', 'Programs - KodeNest ICT Academy')

@section('content')
    {{-- Hero --}}
    <section class="relative pt-24 pb-16 bg-white overflow-hidden text-center">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] bg-orange-50 rounded-full blur-[120px] opacity-40">
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 relative z-10 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 tracking-tight">
                Master the Skills that <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-orange-500">Matter.</span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed font-light max-w-2xl mx-auto">
                Comprehensive tech training designed to launch your career. From beginner to pro.
            </p>
        </div>
    </section>

    {{-- Programs Grid --}}
    <section class="py-12 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($programs->isEmpty())
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Programs are being updated. Check back soon.</p>
                    </div>
                @endif
                @foreach($programs as $program)
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 flex flex-col hover:-translate-y-2 transition-transform duration-300 group">
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
                                {{-- Lessons (Placeholder) --}}
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

                @if($programs->isNotEmpty())
                    {{-- Coming Soon teaser --}}
                    <div class="col-span-full flex flex-col items-center justify-center text-center py-10">
                        <div class="text-5xl mb-4 animate-bounce">🚀</div>
                        <span
                            class="inline-block bg-orange-100 text-orange-600 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4">Coming
                            Soon</span>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">More Programs on the Way</h3>
                        <p class="text-gray-500 text-sm max-w-md leading-relaxed">We're working hard to bring you new courses.
                            Stay tuned and be the first to know!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-white text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Not sure where to start?</h2>
        <p class="text-gray-600 mb-8 max-w-xl mx-auto">Book a free consultation session with our advisors.</p>
        <a href="/contact"
            class="inline-block px-10 py-4 bg-white border-2 border-gray-200 text-gray-900 font-bold rounded-full hover:border-orange-500 hover:text-orange-500 transition-all">
            Talk to an Advisor
        </a>
    </section>
@endsection