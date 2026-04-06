@extends('layouts.public')

@section('title', $program->title . ' - KodeNest')

@section('content')
    {{-- Hero Section --}}
    <section
        class="relative bg-gradient-to-br from-orange-50 via-white to-purple-50 text-gray-900 pt-32 pb-20 px-6 overflow-hidden">
        {{-- Abstract Background --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-600/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-orange-500/5 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/3">
            </div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-3/5">
                    <div class="flex items-center gap-3 mb-6">
                        <span
                            class="px-4 py-1.5 bg-orange-100 border border-orange-200 text-orange-600 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-sm">
                            {{ $program->duration }} Program
                        </span>
                        <span
                            class="px-4 py-1.5 bg-white border border-gray-200 text-gray-600 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-sm shadow-sm">
                            <i class="fas fa-check-circle mr-1 text-green-500"></i> Verified Path
                        </span>
                    </div>

                    <h1
                        class="text-4xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight tracking-tight animate-fade-in-up text-gray-900">
                        {{ $program->title }}
                    </h1>

                    <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl font-medium">
                        {{ $program->target_audience }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="/enroll?program={{ $program->slug }}"
                            class="px-8 py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-orange-600 hover:shadow-lg hover:-translate-y-1 transition-all flex items-center gap-2 shadow-xl">
                            Apply Now <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#curriculum"
                            class="px-8 py-4 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">
                            View Syllabus
                        </a>
                    </div>
                </div>

                <div class="md:w-2/5 flex justify-center relative">
                    @if($program->image_icon)
                        <div class="p-8 animate-[float_6s_ease-in-out_infinite] relative z-10">
                            <img src="{{ asset('storage/' . $program->image_icon) }}" alt="{{ $program->title }}"
                                class="w-80 h-80 object-contain filter drop-shadow-2xl">
                        </div>
                    @else
                        <div class="p-8 animate-[float_6s_ease-in-out_infinite]">
                            <i class="fa-solid fa-graduation-cap text-9xl text-orange-600 drop-shadow-2xl"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Bar --}}
    <div
        class="bg-white border-b border-gray-100 relative z-20 -mt-8 mx-6 rounded-2xl shadow-xl max-w-7xl lg:mx-auto p-8 flex flex-wrap justify-between gap-8">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-orange-600/10 flex items-center justify-center text-orange-600">
                <i class="fas fa-clock text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Duration</p>
                <p class="text-lg font-bold text-gray-900">{{ $program->duration }}</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                <i class="fas fa-video text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Format</p>
                <p class="text-lg font-bold text-gray-900">Online & Physical</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                <i class="fas fa-certificate text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Certification</p>
                <p class="text-lg font-bold text-gray-900">Included</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                <i class="fas fa-signal text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Level</p>
                <p class="text-lg font-bold text-gray-900">Beginner to Pro</p>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid lg:grid-cols-3 gap-16">
            {{-- Left Content --}}
            <div class="lg:col-span-2 space-y-16">

                {{-- About --}}
                <div class="prose prose-lg max-w-none">
                    <h2 class="text-3xl font-black text-gray-900 mb-6 relative inline-block">
                        About This Program
                        <span class="absolute bottom-1 left-0 w-1/2 h-3 bg-orange-200/50 -z-10"></span>
                    </h2>
                    <div class="text-gray-600 leading-8">
                        {!! nl2br(e($program->description)) !!}
                    </div>
                </div>

                {{-- Learning Peaks (Highlights) --}}
                <div>
                    <h2 class="text-3xl font-black text-gray-900 mb-8">Program Highlights</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div
                            class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-orange-600/20 transition-colors group">
                            <div
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-orange-600 mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-project-diagram text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Project-Based Learning</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Build real-world applications and a solid
                                portfolio that employers love.</p>
                        </div>
                        <div
                            class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-blue-500/20 transition-colors group">
                            <div
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-600 mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-chalkboard-teacher text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Expert Mentorship</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Direct access to industry experts who guide you
                                through every step.</p>
                        </div>
                        <div
                            class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-green-500/20 transition-colors group">
                            <div
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-green-600 mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-briefcase text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Career Support</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">CV reviews, interview prep, and freelance
                                guidance to launch your career.</p>
                        </div>
                        <div
                            class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:border-orange-500/20 transition-colors group">
                            <div
                                class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-orange-600 mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-user-friends text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Community Access</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">Join a vibrant community of developers and
                                designers for lifelong networking.</p>
                        </div>
                    </div>
                </div>

                {{-- What You'll Learn (Skills) --}}
                <div>
                    <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
                        Course Outcomes
                        <span class="text-sm font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full">Skills You'll
                            Master</span>
                    </h2>
                    @if(is_array($program->skills))
                        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-xl shadow-gray-100/50">
                            <div class="grid md:grid-cols-2 gap-y-4 gap-x-8">
                                @foreach($program->skills as $skill)
                                    <div class="flex items-start gap-4 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div
                                            class="mt-1 flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                            <i class="fas fa-check text-xs"></i>
                                        </div>
                                        <span class="text-gray-700 font-semibold">{{ $skill }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Tools --}}
                @if($program->tools)
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tools You Will Use</h2>
                        <div class="flex flex-wrap gap-4">
                            @foreach($program->tools as $tool)
                                <div
                                    class="px-6 py-3 bg-white border border-gray-200 rounded-xl shadow-sm font-bold text-gray-700 hover:border-gray-300 transition-colors flex items-center gap-2">
                                    <i class="fas fa-layer-group text-gray-400"></i> {{ $tool }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Prerequisites --}}
                <div class="bg-blue-50 rounded-3xl p-8 border border-blue-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Prerequisites</h2>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <span class="text-gray-700 font-medium">A working laptop (Windows or Mac)</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="fas fa-wifi"></i>
                            </div>
                            <span class="text-gray-700 font-medium">Reliable internet connection</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="fas fa-fire"></i>
                            </div>
                            <span class="text-gray-700 font-medium">Passion and willingness to learn (No prior coding
                                experience required!)</span>
                        </li>
                    </ul>
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    {{-- Enrollment Card --}}
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative" id="enroll">
                        <div class="h-3 bg-gradient-to-r from-orange-600 to-orange-500"></div>
                        <div class="p-8">
                            {{-- Enquire about fees --}}
                            <div class="flex items-center gap-3 p-4 bg-orange-50 border border-orange-100 rounded-xl mb-6">
                                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600">
                                    <i class="fas fa-comments text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-900 mb-0.5">Flexible Payment Plans</p>
                                    <a href="/contact" class="text-xs text-orange-600 font-semibold hover:text-orange-700 transition-colors">
                                        Enquire about fees →
                                    </a>
                                </div>
                            </div>

                            <a href="/enroll?program={{ $program->slug }}"
                                class="block w-full py-4 bg-gray-900 text-white text-center font-bold rounded-xl hover:bg-orange-600 hover:shadow-lg hover:-translate-y-1 transition-all mb-6">
                                Apply Now
                            </a>

                            <div class="space-y-4 text-sm text-gray-600">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-chalkboard-teacher text-orange-600 w-5"></i>
                                    <span>Instructor-led training</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-calendar-alt text-orange-600 w-5"></i>
                                    <span>Flexible schedule</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-medal text-orange-600 w-5"></i>
                                    <span>Professional Certificate</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-infinity text-orange-600 w-5"></i>
                                    <span>Lifetime access to community</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 text-center border-t border-gray-100">
                            <p class="text-xs text-gray-500">Secure your spot for the next cohort.</p>
                        </div>
                    </div>

                    {{-- Help Card --}}
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-lg relative overflow-hidden group">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2 group-hover:bg-orange-100 transition-colors">
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4 z-10 relative">Need help deciding?</h3>
                        <p class="text-gray-600 text-sm mb-6 z-10 relative">Our student advisors can help you choose the
                            right path for your career goals.</p>
                        <a href="/contact"
                            class="inline-flex items-center text-orange-600 font-bold hover:text-orange-700 transition-colors z-10 relative">
                            Chat with us <i class="fas fa-comment-alt ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection