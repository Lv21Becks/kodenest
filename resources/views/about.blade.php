@extends('layouts.public')

@section('title', 'About KodeNest - ICT Academy')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-24 pb-16 bg-white overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-orange-50 rounded-full blur-[100px] opacity-60"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-purple-50 rounded-full blur-[100px] opacity-60">
        </div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 tracking-tight">
                Empowering Africa's <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-pink-600">Digital
                    Future.</span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed font-light">
                We believe that talent is evenly distributed, but opportunity is not.
                KodeNest exists to bridge that gap with world-class tech education.
            </p>
        </div>
    </section>

    {{-- Mission & Vision (Clean Layout) --}}
    <section class="py-20 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 lg:gap-20">
                <div class="animate-fade-in-up delay-100">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-orange-600 text-3xl shadow-sm mb-6">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        To democratize tech education in Africa by providing accessible, high-quality training.
                        We equip individuals with practical skills needed to succeed in the global digital economy.
                    </p>
                </div>

                <div class="animate-fade-in-up delay-200">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-purple-600 text-3xl shadow-sm mb-6">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        To become Africa's leading ICT training academy, recognized for producing job-ready tech
                        professionals who drive innovation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Story (Minimalist) --}}
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div
                class="inline-block px-4 py-1 border border-gray-200 rounded-full text-gray-500 text-xs font-bold uppercase tracking-wider mb-8">
                Our Story
            </div>

            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-10">
                It started with a simple idea.
            </h2>

            <div class="space-y-8 text-lg text-gray-600 leading-relaxed font-light">
                <p>
                    KodeNest ICT Academy was founded on the belief that everyone deserves access to quality tech education.
                    Recognizing the growing demand for tech skills in Africa and the limited opportunities for many aspiring
                    professionals,
                    we set out to create a learning environment that is welcoming, practical, and results-oriented.
                </p>
                <p>
                    Located in Ughelli, Delta State, we started with a handful of students and a passion for teaching.
                    Today, we've grown into a thriving community of learners, instructors, and tech enthusiasts.
                </p>
            </div>
        </div>
    </section>

    {{-- Core Values (Grid) --}}
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Core Values</h2>
                <p class="text-gray-500">The principles that guide everything we do</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Value 1 --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform duration-300">
                    <i class="fas fa-lightbulb text-orange-500 text-3xl mb-4"></i>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Excellence</h4>
                    <p class="text-gray-500 text-sm">We maintain high standards in our curriculum and instruction.</p>
                </div>

                {{-- Value 2 --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform duration-300">
                    <i class="fas fa-hands-helping text-orange-500 text-3xl mb-4"></i>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Accessibility</h4>
                    <p class="text-gray-500 text-sm">Tech education should be available to everyone.</p>
                </div>

                {{-- Value 3 --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform duration-300">
                    <i class="fas fa-graduation-cap text-orange-500 text-3xl mb-4"></i>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Practical Learning</h4>
                    <p class="text-gray-500 text-sm">We focus on hands-on, project-based learning.</p>
                </div>

                {{-- Value 4 --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform duration-300">
                    <i class="fas fa-seedling text-orange-500 text-3xl mb-4"></i>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Innovation</h4>
                    <p class="text-gray-500 text-sm">We continuously update our programs.</p>
                </div>

                {{-- Value 5 --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform duration-300">
                    <i class="fas fa-users text-orange-500 text-3xl mb-4"></i>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Community</h4>
                    <p class="text-gray-500 text-sm">Students, instructors, and alumni growing together.</p>
                </div>

                {{-- Value 6 --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:-translate-y-1 transition-transform duration-300">
                    <i class="fas fa-star text-orange-500 text-3xl mb-4"></i>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Integrity</h4>
                    <p class="text-gray-500 text-sm">Transparency, honesty, and accountability.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 bg-white text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Ready to Start?</h2>
            <p class="text-xl text-gray-600 mb-10">Join hundreds of students who have transformed their careers.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/programs"
                    class="px-10 py-4 bg-gray-900 text-white font-bold text-lg rounded-full hover:scale-105 transition-transform duration-300 shadow-xl">
                    View Programs
                </a>
                <a href="/contact"
                    class="px-10 py-4 bg-white border border-gray-200 text-gray-900 font-bold text-lg rounded-full hover:bg-gray-50 transition-colors">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection