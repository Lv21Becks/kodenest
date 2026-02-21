<footer class="bg-[#111111] text-white pt-10 border-t border-gray-900 font-sans">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Column 1: KODENEST + Address + Email --}}
            <div class="space-y-3">
                <h3 class="text-xl font-bold text-white uppercase tracking-wider flex items-center">
                    K<img src="{{ asset('images/KodeNest.png') }}" alt="O"
                        class="h-6 w-auto inline-block align-middle mx-[1px] transform -translate-y-[2px]">DENEST
                </h3>
                <div class="text-gray-400 text-sm space-y-2">
                    <p class="leading-relaxed">
                        154 Isoko Road, By NNPC Roundabout, Ughelli, Delta State
                    </p>
                    <a href="mailto:Kodenestlimited@gmail.com" class="block hover:text-orange-500 transition-colors">
                        Kodenestlimited@gmail.com
                    </a>
                </div>
            </div>

            {{-- Column 2: Courses + Blog --}}
            <div class="flex flex-col space-y-2">
                <a href="/programs"
                    class="text-base font-bold text-gray-200 hover:text-orange-500 transition-colors w-fit">
                    Courses
                </a>
                <a href="/blog" class="text-base font-bold text-gray-200 hover:text-orange-500 transition-colors w-fit">
                    Blog
                </a>
            </div>

            {{-- Column 3: About + Testimonials + Policy --}}
            <div class="flex flex-col space-y-2">
                <a href="/about"
                    class="text-base font-bold text-gray-200 hover:text-orange-500 transition-colors w-fit">
                    About KODENEST
                </a>
                <a href="/testimonials"
                    class="text-base font-bold text-gray-200 hover:text-orange-500 transition-colors w-fit">
                    Testimonials
                </a>
                {{-- "Mission and policy page with a one word link" -> Using "Policy" --}}
                <a href="/privacy-policy"
                    class="text-base font-bold text-gray-200 hover:text-orange-500 transition-colors w-fit">
                    Policy
                </a>
            </div>
        </div>

        {{-- Follow Us Section --}}
        <div>
            <div class="flex items-center gap-4 mb-4">
                <h4 class="text-lg font-bold text-white uppercase tracking-wider">Follow us</h4>

                {{-- Vertical Separator --}}
                <div class="h-5 w-0.5 bg-white"></div>

                <div class="flex gap-4">
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center text-white hover:text-orange-500 transition-colors text-lg">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/kodenest/"
                        class="w-8 h-8 flex items-center justify-center text-white hover:text-orange-500 transition-colors text-lg">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center text-white hover:text-orange-500 transition-colors text-lg">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 flex items-center justify-center text-white hover:text-orange-500 transition-colors text-lg">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="h-0.5 bg-gray-800 w-full mb-4"></div>

            <p class="text-xs text-gray-500 font-medium tracking-wide pb-6">
                Copyright 2026 KODENEST LIMITED B.V.
            </p>
        </div>
    </div>
</footer>