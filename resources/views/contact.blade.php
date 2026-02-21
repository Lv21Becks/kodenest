@extends('layouts.public')

@section('title', 'Contact Us - KodeNest ICT Academy')

@section('content')
    {{-- Hero --}}
    <section class="pt-24 pb-12 bg-white text-center">
        <div class="max-w-4xl mx-auto px-6 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                Get in <span class="text-orange-500">Touch</span>
            </h1>
            <p class="text-xl text-gray-600 font-light">
                Have questions? We're here to help you start your tech journey.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 pb-24">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20">

            {{-- Contact Form --}}
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl border border-gray-100 animate-fade-in-up delay-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Send Us a Message</h2>

                <form id="contactForm" class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-bold mb-2 text-sm">Full Name</label>
                        <input type="text" id="name" name="name" required placeholder="John Doe"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-bold mb-2 text-sm">Email Address</label>
                        <input type="email" id="email" name="email" required placeholder="john@example.com"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label for="phone" class="block text-gray-700 font-bold mb-2 text-sm">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required placeholder="+234..."
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label for="subject" class="block text-gray-700 font-bold mb-2 text-sm">Subject</label>
                        <div class="relative">
                            <select id="subject" name="subject" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white transition-all appearance-none cursor-pointer">
                                <option value="">Select a subject</option>
                                <option value="enrollment">Enrollment Inquiry</option>
                                <option value="program">Program Information</option>
                                <option value="partnership">Partnership Opportunity</option>
                                <option value="other">Other</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 font-bold mb-2 text-sm">Message</label>
                        <textarea id="message" name="message" required placeholder="How can we help?" rows="4"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white transition-all resize-none"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-gray-900 text-white font-bold text-lg rounded-xl hover:bg-orange-600 hover:shadow-lg transition-all duration-300">
                        Send Message
                    </button>
                </form>
            </div>

            {{-- Contact Information --}}
            <div class="flex flex-col gap-8 animate-fade-in-up delay-200">

                {{-- Info Cards --}}
                <div
                    class="bg-gray-50 rounded-2xl p-8 flex items-start gap-6 hover:bg-white hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div
                        class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 text-xl shrink-0">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Email Us</h3>
                        <p class="text-gray-500 mb-2 text-sm">We almost always respond within 24 hours.</p>
                        <a href="mailto:Kodenestlimited@gmail.com"
                            class="text-orange-600 font-semibold hover:underline">Kodenestlimited@gmail.com</a>
                    </div>
                </div>

                <div
                    class="bg-gray-50 rounded-2xl p-8 flex items-start gap-6 hover:bg-white hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div
                        class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 text-xl shrink-0">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Call Us</h3>
                        <p class="text-gray-500 mb-2 text-sm">Mon - Fri: 8am - 4pm</p>
                        <a href="tel:07016262826" class="text-gray-900 font-bold hover:underline">07016262826</a>
                    </div>
                </div>

                <div
                    class="bg-gray-50 rounded-2xl p-8 flex items-start gap-6 hover:bg-white hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div
                        class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xl shrink-0">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Visit Us</h3>
                        <p class="text-gray-600">154 Isoko Road, By NNPC Roundabout,<br>Ughelli, Delta State</p>
                    </div>
                </div>

                {{-- Socials --}}
                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Connect With Us</h3>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition-all"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#"
                            class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-sky-500 hover:text-white transition-all"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#"
                            class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-pink-600 hover:text-white transition-all"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#"
                            class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-green-600 hover:text-white transition-all"><i
                                class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Map Section --}}
    <section class="h-[400px] w-full bg-gray-100 relative border-t border-gray-200">
        <iframe width="100%" height="100%"
            class="absolute inset-0 w-full h-full grayscale hover:grayscale-0 transition-all duration-700" frameborder="0"
            title="KodeNest Location" marginheight="0" marginwidth="0" scrolling="no"
            src="https://maps.google.com/maps?q=154%20Isoko%20Road,%20Ughelli,%20Delta%20State&t=&z=15&ie=UTF8&iwloc=&output=embed">
        </iframe>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();
            // Simple visual feedback
            const btn = this.querySelector('button');
            const originalText = btn.innerText;
            btn.innerText = 'Sending...';
            btn.disabled = true;

            setTimeout(() => {
                alert('Thank you! We will get back to you shortly.');
                this.reset();
                btn.innerText = originalText;
                btn.disabled = false;
            }, 1000);
        });
    </script>
@endpush