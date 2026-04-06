@extends('layouts.public')

@section('title', 'Success Stories - KodeNest ICT Academy')

@section('content')
@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-24 pb-16 bg-white overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-orange-50 rounded-full blur-[100px] opacity-60"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-purple-50 rounded-full blur-[100px] opacity-60">
        </div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 tracking-tight">
                Real Stories, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-orange-500">Real
                    Impact.</span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed font-light">
                Discover how KodeNest is transforming lives and careers across Africa through world-class tech education.
            </p>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-12 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-2xl text-center shadow-sm border border-gray-100">
                    <div class="text-4xl font-bold text-orange-600 mb-2">500+</div>
                    <div class="text-gray-600 font-medium">Students Trained</div>
                </div>
                <div class="bg-white p-8 rounded-2xl text-center shadow-sm border border-gray-100">
                    <div class="text-4xl font-bold text-purple-600 mb-2">85%</div>
                    <div class="text-gray-600 font-medium">Job Placement Rate</div>
                </div>
                <div class="bg-white p-8 rounded-2xl text-center shadow-sm border border-gray-100">
                    <div class="text-4xl font-bold text-pink-600 mb-2">50+</div>
                    <div class="text-gray-600 font-medium">Partner Companies</div>
                </div>
                <div class="bg-white p-8 rounded-2xl text-center shadow-sm border border-gray-100">
                    <div class="text-4xl font-bold text-blue-600 mb-2">4.9/5</div>
                    <div class="text-gray-600 font-medium">Average Rating</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Grid --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">What Our Students Say</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Hear directly from the people who have walked the path before
                    you.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($testimonials as $testimonial)
                    <div
                        class="bg-gray-50 p-8 rounded-2xl border border-gray-100 hover:-translate-y-2 transition-transform duration-300 relative group">
                        <div class="text-6xl text-orange-200 absolute top-4 right-6 font-serif opacity-50">"</div>
                        <p class="text-gray-700 leading-relaxed mb-8 relative z-10">{{ $testimonial->content }}</p>
                        <div class="flex items-center gap-4 border-t border-gray-200 pt-6">
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}"
                                    class="w-12 h-12 rounded-full object-cover ring-2 ring-white">
                            @else
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-orange-600 to-orange-500 rounded-full flex items-center justify-center text-white text-sm font-bold ring-2 ring-white">
                                    {{ substr($testimonial->name, 0, 1) }}{{ substr(explode(' ', $testimonial->name)[1] ?? '', 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $testimonial->name }}</h4>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">{{ $testimonial->position }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">More success stories coming soon!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Featured Stories --}}
    <section class="py-24 bg-gray-50 border-t border-gray-100">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-16 text-center">Featured Journeys</h2>

            <div class="space-y-12">
                {{-- Story 1 --}}
                <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100">
                    <div class="flex flex-col md:flex-row gap-8 md:gap-12">
                        <div class="md:w-1/3 flex flex-col items-center text-center">
                            <img src="{{ asset('images/tunde-johnson.png') }}" alt="Tunde Johnson"
                                class="w-32 h-32 rounded-full object-cover object-top mb-6 shadow-lg ring-4 ring-orange-100">
                            <h3 class="font-bold text-xl text-gray-900">Tunde Johnson</h3>
                            <p class="text-sm text-gray-500 mb-4">Software Developer</p>
                            <span
                                class="px-4 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Employed</span>
                        </div>
                        <div class="md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">From Unemployed to Software Engineer</h3>
                            <div class="prose prose-gray text-gray-600 leading-relaxed mb-6">
                                <p class="mb-4">"I had always been interested in tech but never thought I could become a
                                    developer. KodeNest changed that mindset. The instructors broke down complex concepts
                                    into
                                    understandable pieces."</p>
                                <p>After the 20-week program, Tunde built a portfolio that landed him a role at a
                                    Lagos-based startup within 2 months.</p>
                            </div>
                            <div class="pl-4 border-l-4 border-orange-500 bg-orange-50 p-4 rounded-r-lg">
                                <p class="text-sm font-bold text-gray-900">Current Role:</p>
                                <p class="text-sm text-gray-600">Junior Engineer at InnovateNG</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Story 2 --}}
                <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100">
                    <div class="flex flex-col md:flex-row gap-8 md:gap-12">
                        <div class="md:w-1/3 flex flex-col items-center text-center">
                            <img src="{{ asset('images/sandra-adekunle.png') }}" alt="Sandra Adekunle"
                                class="w-32 h-32 rounded-full object-cover object-top mb-6 shadow-lg ring-4 ring-purple-100">
                            <h3 class="font-bold text-xl text-gray-900">Sandra Adekunle</h3>
                            <p class="text-sm text-gray-500 mb-4">Data Analyst</p>
                            <span
                                class="px-4 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Employed</span>
                        </div>
                        <div class="md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Building a Data Career from Scratch</h3>
                            <div class="prose prose-gray text-gray-600 leading-relaxed mb-6">
                                <p class="mb-4">"The instructors made everything accessible. We learned by analyzing real
                                    datasets. It felt like actual work experience, not just a classroom."</p>
                                <p>Sandra transitioned from a sales role to a Data Analyst position at a financial services
                                    firm.</p>
                            </div>
                            <div class="pl-4 border-l-4 border-purple-500 bg-purple-50 p-4 rounded-r-lg">
                                <p class="text-sm font-bold text-gray-900">Current Role:</p>
                                <p class="text-sm text-gray-600">Data Analyst at FirstFinance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 bg-white text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Start Your Journey</h2>
            <p class="text-xl text-gray-600 mb-10">Join the next cohort of success stories.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/programs"
                    class="px-10 py-4 bg-gray-900 text-white font-bold text-lg rounded-full hover:scale-105 transition-transform duration-300 shadow-xl">
                    View Programs
                </a>
                <a href="/contact"
                    class="px-10 py-4 bg-white border border-gray-200 text-gray-900 font-bold text-lg rounded-full hover:bg-gray-50 transition-colors">
                    Contact Admissions
                </a>
            </div>
        </div>
    </section>
@endsection