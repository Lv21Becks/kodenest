<nav class="sticky top-0 z-50 bg-slate-600 shadow-sm border-b border-slate-800"
    x-data="{ open: false, coursesOpen: false }">
    <div class="max-w-7xl mx-auto px-6 py-3">
        <div class="flex justify-between items-center relative">
            {{-- Left: Logo --}}
            <a href="/" class="flex items-center z-20">
                <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest Logo" class="h-16 w-auto">
            </a>

            {{-- Center: Links (Absolute Centered) --}}
            <div class="hidden xl:flex absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                <ul class="flex items-center gap-8 text-gray-200 font-medium text-[15px]">
                    {{-- Courses Dropdown --}}
                    <li class="relative" @mouseenter="coursesOpen = true" @mouseleave="coursesOpen = false">
                        <button class="flex items-center gap-1 hover:text-orange-500 transition-colors py-6">
                            Courses
                            <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': coursesOpen}" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Mega Dropdown --}}
                        <div x-show="coursesOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-1/2 -translate-x-1/2 top-full mt-0 w-[500px] bg-white shadow-2xl rounded-xl border-t-2 border-orange-500 overflow-hidden"
                            x-cloak>
                            <div class="p-6">
                                <h3
                                    class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wide border-b border-gray-100 pb-2">
                                    Available Programs
                                </h3>
                                <div class="grid grid-cols-1 gap-y-1">
                                    @forelse($navbarPrograms as $program)
                                        <a href="{{ route('programs.show', $program->slug) }}"
                                            class="group flex items-center justify-between py-2 px-3 rounded-lg hover:bg-orange-50 transition-colors">
                                            <span class="text-gray-600 group-hover:text-orange-700 font-medium text-sm">
                                                {{ $program->title }}
                                            </span>
                                            <i
                                                class="fas fa-chevron-right text-xs text-orange-300 group-hover:text-orange-500 opacity-0 group-hover:opacity-100 transition-all transform group-hover:translate-x-1"></i>
                                        </a>
                                    @empty
                                        <p class="text-gray-500 text-sm py-2">No programs currently available.</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100">
                                <a href="/programs"
                                    class="text-orange-600 font-bold text-sm hover:text-orange-700 inline-flex items-center gap-2 transition-colors">
                                    View Full Curriculum <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </li>

                    <li><a href="/about" class="hover:text-orange-500 transition-colors">About</a></li>
                    <li><a href="/testimonials" class="hover:text-orange-500 transition-colors">Testimonials</a></li>
                    <li><a href="/blog" class="hover:text-orange-500 transition-colors">Blog</a></li>
                    <li><a href="/contact" class="hover:text-orange-500 transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- Right: Actions (Call + Enroll) --}}
            <div class="hidden xl:flex items-center gap-6 z-20">
                <a href="tel:+2347016262826" class="flex items-center gap-2 group">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-400 font-medium">Call Us</span>
                        <span class="text-base font-bold text-white group-hover:text-orange-500 transition-colors">0701
                            626 2826</span>
                    </div>
                </a>

                <a href="/enroll"
                    class="px-6 py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-all text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Enroll Now
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="open = !open" class="xl:hidden text-white focus:outline-none z-20">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="xl:hidden absolute top-full left-0 w-full bg-slate-900 border-t border-slate-800 shadow-xl z-40 h-screen"
        x-cloak>
        <ul class="flex flex-col p-6 gap-2 text-gray-200 font-medium">
            <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[100ms]"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4">
                <a href="/programs"
                    class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                    Courses
                </a>
            </li>
            <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[150ms]"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4">
                <a href="/about"
                    class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                    About
                </a>
            </li>
            <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[200ms]"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4">
                <a href="/testimonials"
                    class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                    Testimonials
                </a>
            </li>
            <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[250ms]"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4">
                <a href="/blog"
                    class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                    Blog
                </a>
            </li>
            <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[300ms]"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4">
                <a href="/contact"
                    class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                    Contact
                </a>
            </li>
            <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[350ms]"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
                class="pt-4 mt-2 border-t border-slate-800">
                <a href="/enroll"
                    class="block text-center w-full px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-all">
                    Enroll Now
                </a>
            </li>
        </ul>
    </div>
</nav>