<style>
@keyframes breathe {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.03); }
}
.animate-breathe { animation: breathe 2s infinite ease-in-out; }
</style>
<div class="fixed top-0 w-full z-50 px-4 sm:px-6 mt-4 pointer-events-none" x-data="{ open: false, coursesOpen: false }">
    <nav
        class="mx-auto max-w-6xl bg-[#0a192f]/95 backdrop-blur-xl border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.2)] rounded-full transition-all duration-300 pointer-events-auto">
        <div class="px-6 py-2.5">
            <div class="flex justify-between items-center relative">
                {{-- Left: Logo --}}
                <a href="/" class="flex items-center z-20">
                    <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest Logo" class="h-11 w-auto">
                </a>

                {{-- Center: Links (Responsive Flex) --}}
                <div class="hidden xl:flex flex-1 justify-center px-4">
                    <ul class="flex items-center gap-8 text-gray-300 font-medium text-sm tracking-wide ml-32">
                        {{-- Courses Dropdown --}}
                        <li class="relative" @mouseenter="coursesOpen = true" @mouseleave="coursesOpen = false" @click.stop>
                            <button
                                class="flex items-center gap-1.5 font-semibold text-white hover:text-orange-400 transition-colors py-3">
                                Courses
                                <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': coursesOpen}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                class="absolute left-1/2 -translate-x-1/2 top-full mt-6 w-[500px] bg-white shadow-2xl rounded-2xl border border-gray-100 overflow-hidden"
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

                        <li><a href="/about" class="hover:text-white transition-colors py-3 inline-block">About</a></li>
                        <li><a href="/testimonials"
                                class="hover:text-white transition-colors py-3 inline-block">Testimonials</a></li>
                        <li><a href="/blog" class="hover:text-white transition-colors py-3 inline-block">Blog</a></li>
                        <li><a href="/contact" class="hover:text-white transition-colors py-3 inline-block">Contact</a>
                        </li>
                    </ul>
                </div>

                {{-- Right: Actions (Call + Enroll) --}}
                <div class="hidden xl:flex items-center gap-6 z-20">
                    <a href="tel:+2347016262826" class="flex items-center gap-2 group">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-400 font-medium">Call Us</span>
                            <span
                                class="text-base font-bold text-white group-hover:text-orange-500 transition-colors">0701
                                626 2826</span>
                        </div>
                    </a>

                    <a href="/enroll"
                        class="animate-breathe px-7 py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-full transition-all text-sm shadow-[0_4px_14px_0_rgba(249,115,22,0.39)] hover:shadow-[0_6px_20px_rgba(249,115,22,0.23)] hover:-translate-y-0.5 ring-1 ring-orange-500/50">
                        Apply Now
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button @click="open = !open" class="xl:hidden text-white focus:outline-none z-20">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="xl:hidden absolute top-full left-0 w-full mt-4 bg-[#0a192f]/95 backdrop-blur-xl border border-white/10 shadow-2xl z-40 rounded-3xl overflow-hidden pointer-events-auto"
            x-cloak>
            <ul class="flex flex-col p-6 gap-2 text-gray-200 font-medium">
                <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[100ms]"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4">
                    <a href="/programs"
                        class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                        Courses
                    </a>
                </li>
                <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[150ms]"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4">
                    <a href="/about"
                        class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                        About
                    </a>
                </li>
                <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[200ms]"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4">
                    <a href="/testimonials"
                        class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                        Testimonials
                    </a>
                </li>
                <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[250ms]"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4">
                    <a href="/blog"
                        class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                        Blog
                    </a>
                </li>
                <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[300ms]"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4">
                    <a href="/contact"
                        class="block py-3 px-4 hover:bg-slate-800 hover:text-orange-400 rounded-lg transition-all">
                        Contact
                    </a>
                </li>
                <li x-show="open" x-transition:enter="transition ease-out duration-500 delay-[350ms]"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4" class="pt-4 mt-2 border-t border-slate-800">
                    <a href="/enroll"
                        class="animate-breathe block text-center w-full px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-all">
                        Apply Now
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>