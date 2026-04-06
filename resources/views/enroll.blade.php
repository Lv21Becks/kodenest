@extends('layouts.public')

@section('title', 'Apply Now - KodeNest ICT Academy')
@section('body_class', 'bg-gray-50')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-24 pb-16 bg-white overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-orange-50 rounded-full blur-[100px] opacity-60"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-purple-50 rounded-full blur-[100px] opacity-60"></div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 tracking-tight">
                Apply to Join <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-orange-500">
                    KodeNest Academy
                </span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed font-light max-w-2xl mx-auto">
                Get trained with industry-relevant skills and real-world projects designed to prepare you for tech careers.
            </p>

            {{-- Trust Stats Bar --}}
            <div class="mt-10 flex flex-wrap justify-center gap-8 md:gap-12 text-center">
                <div>
                    <p class="text-2xl font-bold text-gray-900">500+</p>
                    <p class="text-gray-500 text-sm">Students Trained</p>
                </div>
                <div class="hidden md:block w-px bg-gray-200"></div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">85%</p>
                    <p class="text-gray-500 text-sm">Completion Rate</p>
                </div>
                <div class="hidden md:block w-px bg-gray-200"></div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">Real Projects</p>
                    <p class="text-gray-500 text-sm">Hands-on Learning</p>
                </div>
                <div class="hidden md:block w-px bg-gray-200"></div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">24–48hrs</p>
                    <p class="text-gray-500 text-sm">Review Response</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50 border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid lg:grid-cols-3 gap-8">

                {{-- Form Section --}}
                <div class="lg:col-span-2 bg-white rounded-2xl p-8 md:p-12 shadow-lg">

                    {{-- Step Indicator --}}
                    <div class="flex items-center justify-between mb-12 relative">
                        {{-- Connector lines --}}
                        <div class="absolute top-5 left-[calc(16.67%)] right-[calc(16.67%)] h-0.5 bg-gray-200 z-0"></div>

                        <div class="step flex-1 text-center relative z-10">
                            <div class="step-number w-10 h-10 bg-gradient-to-r from-orange-600 to-orange-500 text-white rounded-full inline-flex items-center justify-center font-bold mb-2 shadow-md shadow-orange-200">
                                1</div>
                            <div class="text-xs font-bold text-gray-600 uppercase tracking-wide">Profile Details</div>
                        </div>
                        <div class="step flex-1 text-center relative z-10">
                            <div class="step-number w-10 h-10 bg-gray-200 text-gray-500 rounded-full inline-flex items-center justify-center font-bold mb-2">
                                2</div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-wide">Programme Selection</div>
                        </div>
                        <div class="step flex-1 text-center relative z-10">
                            <div class="step-number w-10 h-10 bg-gray-200 text-gray-500 rounded-full inline-flex items-center justify-center font-bold mb-2">
                                3</div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-wide">Review & Submit</div>
                        </div>
                    </div>

                    <form id="applicationForm">

                        {{-- Step 1: Profile Details --}}
                        <div class="form-step" data-step="1">
                            <h2 class="text-orange-600 text-3xl font-bold mb-2">Profile Details</h2>
                            <p class="text-gray-500 mb-8">Please provide your basic information so we can get to know you.</p>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-800 font-semibold mb-2">First Name <span class="text-pink-700">*</span></label>
                                    <input type="text" name="firstName" required placeholder="Enter your first name"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm focus:shadow-orange-50 transition-all hover:border-gray-300">
                                </div>
                                <div>
                                    <label class="block text-gray-800 font-semibold mb-2">Last Name <span class="text-pink-700">*</span></label>
                                    <input type="text" name="lastName" required placeholder="Enter your last name"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm focus:shadow-orange-50 transition-all hover:border-gray-300">
                                </div>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Email Address <span class="text-pink-700">*</span></label>
                                <input type="email" name="email" required placeholder="your.email@example.com"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300">
                                <p class="text-xs text-gray-400 mt-1.5">We'll only use this to contact you about your application.</p>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Phone Number <span class="text-pink-700">*</span></label>
                                <input type="tel" name="phone" required placeholder="+234 XXX XXX XXXX"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300">
                                <p class="text-xs text-gray-400 mt-1.5">We'll only use this to contact you about your application.</p>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Gender <span class="text-pink-700">*</span></label>
                                <select name="gender" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Prefer not to say</option>
                                </select>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Address</label>
                                <textarea name="address" placeholder="Enter your address" rows="3"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300 resize-none"></textarea>
                            </div>
                        </div>

                        {{-- Step 2: Programme Selection --}}
                        <div class="form-step hidden" data-step="2">
                            <h2 class="text-orange-600 text-3xl font-bold mb-2">Programme Selection</h2>
                            <p class="text-gray-500 mb-8">Choose your programme and tell us a bit about yourself.</p>

                            <div>
                                <label class="block text-gray-800 font-semibold mb-2">Select Programme <span class="text-pink-700">*</span></label>
                                <select name="program" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300">
                                    <option value="">Choose a programme</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->slug }}" {{ request('program') == $program->slug ? 'selected' : '' }}>
                                            {{ $program->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Learning Mode <span class="text-pink-700">*</span></label>
                                <select name="mode" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300">
                                    <option value="">Select learning mode</option>
                                    <option value="online">Online</option>
                                    <option value="physical">Physical</option>
                                    <option value="hybrid">Hybrid (Online + Physical)</option>
                                </select>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Current Experience Level <span class="text-pink-700">*</span></label>
                                <select name="experience" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300">
                                    <option value="">Select your level</option>
                                    <option value="beginner">Complete Beginner</option>
                                    <option value="some-knowledge">Some Knowledge</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">
                                    Why do you want to join this programme? <span class="text-gray-400 font-normal text-sm">(Optional)</span>
                                </label>
                                <textarea name="motivation" rows="4"
                                    placeholder="Tell us your goals and what you hope to achieve..."
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300 resize-none"></textarea>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">How did you hear about us?</label>
                                <select name="referral"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 shadow-sm transition-all hover:border-gray-300">
                                    <option value="">Select an option</option>
                                    <option value="social-media">Social Media</option>
                                    <option value="friend">Friend/Family</option>
                                    <option value="search-engine">Search Engine</option>
                                    <option value="advertisement">Advertisement</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        {{-- Step 3: Review & Submit --}}
                        <div class="form-step hidden" data-step="3">
                            <h2 class="text-orange-600 text-3xl font-bold mb-2">Review & Submit</h2>
                            <p class="text-gray-500 mb-8">Review your information carefully before submitting your application.</p>

                            <div id="reviewInfo" class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm mb-8 space-y-5">
                                {{-- Review details inserted by JS --}}
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <input type="checkbox" id="updates" name="updates" class="mt-1 w-4 h-4 accent-orange-600 cursor-pointer">
                                    <label for="updates" class="text-gray-700 text-sm">I'd like to receive updates and information from KodeNest</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between gap-4 mt-10">
                            <button type="button" id="prevBtn"
                                class="hidden px-8 py-4 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>Previous
                            </button>
                            <button type="button" id="nextBtn"
                                class="ml-auto px-8 py-4 bg-gradient-to-r from-orange-600 to-orange-500 text-white font-semibold rounded-xl hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-200 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                                Next <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                            <button type="submit" id="submitBtn"
                                class="hidden ml-auto px-10 py-4 bg-gradient-to-r from-orange-600 to-orange-500 text-white font-bold rounded-xl hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-200 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                                <i class="fas fa-paper-plane mr-2"></i>Submit Application
                            </button>
                        </div>
                    </form>

                    {{-- Success Message --}}
                    <div id="successMessage" class="hidden text-center py-12">
                        <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-green-100">
                            <i class="fas fa-check text-green-600 text-4xl"></i>
                        </div>
                        <h2 class="text-green-600 text-3xl font-bold mb-4">Application Submitted!</h2>
                        <p class="text-gray-600 text-lg mb-4">
                            Your application has been received and is currently under review.
                        </p>
                        <p class="text-gray-600 text-lg mb-8">
                            Our team will contact you within <strong>24–48 hours</strong> with next steps.
                        </p>
                        <a href="/"
                            class="inline-block px-10 py-4 bg-gradient-to-r from-orange-600 to-orange-500 text-white font-semibold rounded-full hover:-translate-y-1 hover:shadow-lg hover:shadow-orange-200 transition-all duration-300 hover:scale-[1.02]">
                            Return to Home
                        </a>
                    </div>
                </div>

                {{-- Info Section --}}
                <div class="space-y-8">

                    <div class="bg-white rounded-2xl p-8 shadow-lg">
                        <h3 class="text-orange-600 text-xl font-bold mb-5 flex items-center gap-2">
                            <i class="fas fa-list-check text-orange-400"></i> What Happens Next?
                        </h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3 text-gray-600 text-sm">
                                <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs font-bold mt-0.5">1</span>
                                <span>You'll receive a <strong>confirmation email</strong> acknowledging your application</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600 text-sm">
                                <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs font-bold mt-0.5">2</span>
                                <span>Our team will <strong>review your application</strong> within 24–48 hours</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600 text-sm">
                                <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs font-bold mt-0.5">3</span>
                                <span>You'll receive an <strong>acceptance notification</strong> with onboarding details</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600 text-sm">
                                <span class="flex-shrink-0 w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs font-bold mt-0.5">4</span>
                                <span>Complete your <strong>enrolment & onboarding</strong> and join your cohort</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-lg">
                        <h3 class="text-orange-600 text-xl font-bold mb-5 flex items-center gap-2">
                            <i class="fas fa-shield-halved text-orange-400"></i> Why KodeNest?
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-gray-600 text-sm">
                                <i class="fas fa-check text-green-500 flex-shrink-0 w-4"></i>
                                Flexible payment plans available
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 text-sm">
                                <i class="fas fa-check text-green-500 flex-shrink-0 w-4"></i>
                                Industry-relevant curriculum
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 text-sm">
                                <i class="fas fa-check text-green-500 flex-shrink-0 w-4"></i>
                                Real-world hands-on projects
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 text-sm">
                                <i class="fas fa-check text-green-500 flex-shrink-0 w-4"></i>
                                Dedicated mentorship & support
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 text-sm">
                                <i class="fas fa-check text-green-500 flex-shrink-0 w-4"></i>
                                Certificate upon completion
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-600 to-orange-400"></div>
                        <h4 class="text-gray-900 font-bold mb-3 flex items-center gap-2">
                            <i class="fas fa-headset text-orange-500"></i> Need Help?
                        </h4>
                        <p class="text-gray-500 text-sm mb-4 leading-relaxed">Have questions about the application? Our team is ready to help:</p>
                        <div class="space-y-2">
                            <a href="mailto:Kodenestlimited@gmail.com"
                                class="flex items-center gap-2 text-sm font-semibold text-gray-700 hover:text-orange-600 transition-colors">
                                <i class="fas fa-envelope text-orange-400 w-4"></i> Kodenestlimited@gmail.com
                            </a>
                            <a href="tel:07016262826"
                                class="flex items-center gap-2 text-sm font-semibold text-gray-700 hover:text-orange-600 transition-colors">
                                <i class="fas fa-phone text-orange-400 w-4"></i> 07016262826
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let currentStep = 1;
        const totalSteps = 3;

        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('applicationForm');
        const successMessage = document.getElementById('successMessage');

        function showStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.add('hidden'));
            document.querySelector(`[data-step="${step}"]`).classList.remove('hidden');

            document.querySelectorAll('.step').forEach((s, i) => {
                const stepNum = s.querySelector('.step-number');
                const stepLabel = s.querySelector('div:last-child');
                if (i + 1 === step) {
                    stepNum.className = 'step-number w-10 h-10 bg-gradient-to-r from-orange-600 to-orange-500 text-white rounded-full inline-flex items-center justify-center font-bold mb-2 shadow-md shadow-orange-200';
                    stepLabel.className = 'text-xs font-bold text-gray-700 uppercase tracking-wide';
                } else if (i + 1 < step) {
                    stepNum.className = 'step-number w-10 h-10 bg-green-500 text-white rounded-full inline-flex items-center justify-center font-bold mb-2';
                    stepLabel.className = 'text-xs font-bold text-green-600 uppercase tracking-wide';
                } else {
                    stepNum.className = 'step-number w-10 h-10 bg-gray-200 text-gray-500 rounded-full inline-flex items-center justify-center font-bold mb-2';
                    stepLabel.className = 'text-xs font-bold text-gray-400 uppercase tracking-wide';
                }
            });

            prevBtn.classList.toggle('hidden', step === 1);
            nextBtn.classList.toggle('hidden', step === totalSteps);
            submitBtn.classList.toggle('hidden', step !== totalSteps);

            if (step === 3) showReview();
        }

        function validateStep(step) {
            const currentStepEl = document.querySelector(`[data-step="${step}"]`);
            const inputs = currentStepEl.querySelectorAll('input[required], select[required], textarea[required]');
            for (let input of inputs) {
                if (!input.value.trim()) {
                    input.focus();
                    input.classList.add('border-red-400');
                    setTimeout(() => input.classList.remove('border-red-400'), 2000);
                    return false;
                }
            }
            return true;
        }

        function showReview() {
            const formDataObj = new FormData(form);
            const data = Object.fromEntries(formDataObj);

            const programSelect = form.querySelector('[name="program"]');
            const selectedProgramName = programSelect.options[programSelect.selectedIndex]?.text || data.program;

            const modeSelect = form.querySelector('[name="mode"]');
            const selectedMode = modeSelect.options[modeSelect.selectedIndex]?.text || data.mode;

            const expSelect = form.querySelector('[name="experience"]');
            const selectedExp = expSelect.options[expSelect.selectedIndex]?.text || data.experience;

            const motivation = data.motivation || '—';

            document.getElementById('reviewInfo').innerHTML = `
                <h3 class="text-orange-600 text-lg font-bold mb-4 pb-3 border-b border-gray-100">Your Application Summary</h3>

                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-user text-orange-400 w-4 mt-0.5 flex-shrink-0"></i>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Full Name</p><p class="text-gray-800 font-semibold">${data.firstName} ${data.lastName}</p></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-envelope text-orange-400 w-4 mt-0.5 flex-shrink-0"></i>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Email</p><p class="text-gray-800 font-semibold">${data.email}</p></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-phone text-orange-400 w-4 mt-0.5 flex-shrink-0"></i>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Phone</p><p class="text-gray-800 font-semibold">${data.phone}</p></div>
                    </div>
                    <div class="border-t border-gray-100 pt-3 mt-3 flex items-start gap-3">
                        <i class="fas fa-graduation-cap text-orange-400 w-4 mt-0.5 flex-shrink-0"></i>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Programme</p><p class="text-gray-800 font-semibold">${selectedProgramName}</p></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-laptop text-orange-400 w-4 mt-0.5 flex-shrink-0"></i>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Learning Mode</p><p class="text-gray-800 font-semibold">${selectedMode}</p></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-chart-line text-orange-400 w-4 mt-0.5 flex-shrink-0"></i>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Experience Level</p><p class="text-gray-800 font-semibold">${selectedExp}</p></div>
                    </div>
                    <div class="border-t border-gray-100 pt-3 mt-3 flex items-start gap-3">
                        <i class="fas fa-comment-dots text-orange-400 w-4 mt-0.5 flex-shrink-0"></i>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Motivation</p><p class="text-gray-700 text-sm leading-relaxed">${motivation}</p></div>
                    </div>
                </div>
            `;
        }

        nextBtn.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });

        prevBtn.addEventListener('click', () => {
            currentStep--;
            showStep(currentStep);
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            // Hide step indicators and form, show success
            document.querySelector('.step').closest('.flex').style.display = 'none';
            form.style.display = 'none';
            successMessage.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Initialize
        showStep(1);
    </script>
@endpush