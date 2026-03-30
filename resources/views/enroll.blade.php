@extends('layouts.public')

@section('title', 'Enroll Now - KodeNest ICT Academy')
@section('body_class', 'bg-gray-50')

@section('content')
    {{-- Main Content --}}
    {{-- Hero Section --}}
    <section class="relative pt-24 pb-16 bg-white overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-orange-50 rounded-full blur-[100px] opacity-60"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-purple-50 rounded-full blur-[100px] opacity-60">
        </div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 tracking-tight">
                Start Your <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-orange-500">
                    Tech Journey.
                </span>
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed font-light">
                Take the first step towards a rewarding career. Enroll in one of our expert-led programs today.
            </p>
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
                            <div
                                class="step-number w-10 h-10 bg-gradient-to-r from-orange-600 to-orange-500 text-white rounded-full inline-flex items-center justify-center font-bold mb-2 shadow-md shadow-orange-200">
                                1</div>
                            <div class="text-xs font-bold text-gray-600 uppercase tracking-wide">Personal Info</div>
                        </div>
                        <div class="step flex-1 text-center relative z-10">
                            <div
                                class="step-number w-10 h-10 bg-gray-200 text-gray-500 rounded-full inline-flex items-center justify-center font-bold mb-2">
                                2</div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-wide">Program</div>
                        </div>
                        <div class="step flex-1 text-center relative z-10">
                            <div
                                class="step-number w-10 h-10 bg-gray-200 text-gray-500 rounded-full inline-flex items-center justify-center font-bold mb-2">
                                3</div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-wide">Confirm</div>
                        </div>
                    </div>

                    <form id="enrollmentForm">

                        {{-- Step 1: Personal Information --}}
                        <div class="form-step" data-step="1">
                            <h2 class="text-orange-600 text-3xl font-bold mb-4">Personal Information</h2>
                            <p class="text-gray-600 mb-8">Please provide your basic information</p>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-800 font-semibold mb-2">First Name <span
                                            class="text-pink-700">*</span></label>
                                    <input type="text" name="firstName" required placeholder="Enter your first name"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-gray-800 font-semibold mb-2">Last Name <span
                                            class="text-pink-700">*</span></label>
                                    <input type="text" name="lastName" required placeholder="Enter your last name"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                                </div>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Email Address <span
                                        class="text-pink-700">*</span></label>
                                <input type="email" name="email" required placeholder="your.email@example.com"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Phone Number <span
                                        class="text-pink-700">*</span></label>
                                <input type="tel" name="phone" required placeholder="+234 XXX XXX XXXX"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Gender <span
                                        class="text-pink-700">*</span></label>
                                <select name="gender" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Prefer not to say</option>
                                </select>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Address</label>
                                <textarea name="address" placeholder="Enter your address" rows="3"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors resize-none"></textarea>
                            </div>
                        </div>

                        {{-- Step 2: Program Selection --}}
                        <div class="form-step hidden" data-step="2">
                            <h2 class="text-orange-600 text-3xl font-bold mb-4">Program Selection</h2>
                            <p class="text-gray-600 mb-8">Choose your program and preferences</p>

                            <div>
                                <label class="block text-gray-800 font-semibold mb-2">Select Program <span
                                        class="text-pink-700">*</span></label>
                                <select name="program" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                                    <option value="">Choose a program</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->slug }}" {{ request('program') == $program->slug ? 'selected' : '' }}>
                                            {{ $program->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Learning Mode <span
                                        class="text-pink-700">*</span></label>
                                <select name="mode" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                                    <option value="">Select learning mode</option>
                                    <option value="online">Online</option>
                                    <option value="physical">Physical</option>
                                    <option value="hybrid">Hybrid (Online + Physical)</option>
                                </select>
                            </div>



                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Current Experience Level <span
                                        class="text-pink-700">*</span></label>
                                <select name="experience" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                                    <option value="">Select your level</option>
                                    <option value="beginner">Complete Beginner</option>
                                    <option value="some-knowledge">Some Knowledge</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">How did you hear about us?</label>
                                <select name="referral"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors">
                                    <option value="">Select an option</option>
                                    <option value="social-media">Social Media</option>
                                    <option value="friend">Friend/Family</option>
                                    <option value="search-engine">Search Engine</option>
                                    <option value="advertisement">Advertisement</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="mt-6">
                                <label class="block text-gray-800 font-semibold mb-2">Additional Information or
                                    Questions</label>
                                <textarea name="additionalInfo" placeholder="Tell us anything else we should know..."
                                    rows="4"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-600 transition-colors resize-none"></textarea>
                            </div>
                        </div>

                        {{-- Step 3: Confirmation --}}
                        <div class="form-step hidden" data-step="3">
                            <h2 class="text-orange-600 text-3xl font-bold mb-4">Confirmation</h2>
                            <p class="text-gray-600 mb-8">Review your information and complete enrollment</p>

                            <div id="reviewInfo" class="bg-gray-100 p-6 rounded-xl mb-8">
                                {{-- Review details will be inserted here --}}
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <input type="checkbox" id="terms" name="terms" required class="mt-1">
                                    <label for="terms" class="text-gray-700">I agree to the <a href="#"
                                            class="text-pink-700 hover:text-orange-500">Terms and Conditions</a> and <a
                                            href="#" class="text-pink-700 hover:text-orange-500">Payment Policy</a> <span
                                            class="text-pink-700">*</span></label>
                                </div>

                                <div class="flex items-start gap-3">
                                    <input type="checkbox" id="updates" name="updates" class="mt-1">
                                    <label for="updates" class="text-gray-700">I want to receive updates and information
                                        from KodeNest</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between gap-4 mt-8">
                            <button type="button" id="prevBtn"
                                class="hidden px-8 py-4 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400 transition-colors">Previous</button>
                            <button type="button" id="nextBtn"
                                class="px-8 py-4 bg-gradient-to-r from-orange-600 to-orange-500 text-white font-semibold rounded-lg hover:-translate-y-1 hover:shadow-lg transition-all duration-300">Next</button>
                            <button type="submit" id="submitBtn"
                                class="hidden px-8 py-4 bg-gradient-to-r from-orange-600 to-orange-500 text-white font-semibold rounded-lg hover:-translate-y-1 hover:shadow-lg transition-all duration-300">Complete
                                Enrollment</button>
                        </div>
                    </form>

                    {{-- Success Message --}}
                    <div id="successMessage" class="hidden text-center py-12">
                        <div class="text-7xl mb-6">✅</div>
                        <h2 class="text-green-600 text-3xl font-bold mb-4">Enrollment Successful!</h2>
                        <p class="text-gray-600 text-lg mb-4">Thank you for enrolling at KodeNest ICT Academy. We've sent a
                            confirmation email with next steps and payment instructions to your email address.</p>
                        <p class="text-gray-600 text-lg mb-8">Our team will contact you within 24 hours to complete your
                            registration.</p>
                        <a href="/"
                            class="inline-block px-10 py-4 bg-gradient-to-r from-orange-600 to-orange-500 text-white font-semibold rounded-full hover:-translate-y-1 hover:shadow-lg transition-all duration-300">Return
                            to Home</a>
                    </div>
                </div>

                {{-- Info Section --}}
                <div class="space-y-8">

                    <div class="bg-white rounded-2xl p-8 shadow-lg">
                        <h3 class="text-orange-600 text-xl font-bold mb-4">📋 What Happens Next?</h3>
                        <ul class="space-y-3">
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Receive confirmation email</li>
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Payment instructions sent</li>
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Access to pre-course materials</li>
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Welcome call from our team</li>
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Join your cohort group</li>
                        </ul>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-lg">
                        <h3 class="text-orange-600 text-xl font-bold mb-4">💰 Payment Information</h3>
                        <ul class="space-y-3">
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Flexible payment plans available</li>
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Early bird discounts</li>
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Secure payment methods</li>
                            <li
                                class="text-gray-600 pl-6 relative before:content-['✓'] before:absolute before:left-0 before:text-green-600 before:font-bold">
                                Payment confirmation within 24hrs</li>
                        </ul>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-600 to-orange-400"></div>
                        <h4 class="text-gray-900 font-bold mb-3 flex items-center gap-2">
                            <i class="fas fa-headset text-orange-500"></i> Need Help?
                        </h4>
                        <p class="text-gray-500 text-sm mb-4 leading-relaxed">If you have questions about enrollment, our team is ready to help:</p>
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
        const form = document.getElementById('enrollmentForm');
        const successMessage = document.getElementById('successMessage');

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(s => s.classList.add('hidden'));
            document.querySelector(`[data-step="${step}"]`).classList.remove('hidden');

            // Update step indicators
            document.querySelectorAll('.step').forEach((s, i) => {
                const stepNum = s.querySelector('.step-number');
                if (i + 1 === step) {
                    stepNum.classList.remove('bg-gray-300', 'text-gray-500', 'bg-green-600');
                    stepNum.classList.add('bg-gradient-to-r', 'from-orange-600', 'to-orange-500', 'text-white');
                } else if (i + 1 < step) {
                    stepNum.classList.remove('bg-gray-300', 'text-gray-500', 'bg-gradient-to-r', 'from-orange-600', 'to-orange-500');
                    stepNum.classList.add('bg-green-600', 'text-white');
                } else {
                    stepNum.classList.remove('bg-gradient-to-r', 'from-orange-600', 'to-orange-500', 'text-white', 'bg-green-600');
                    stepNum.classList.add('bg-gray-300', 'text-gray-500');
                }
            });

            // Update buttons
            prevBtn.classList.toggle('hidden', step === 1);
            nextBtn.classList.toggle('hidden', step === totalSteps);
            submitBtn.classList.toggle('hidden', step !== totalSteps);

            if (step === 3) {
                showReview();
            }
        }

        function validateStep(step) {
            const currentStepEl = document.querySelector(`[data-step="${step}"]`);
            const inputs = currentStepEl.querySelectorAll('input[required], select[required], textarea[required]');

            for (let input of inputs) {
                if (!input.value) {
                    input.focus();
                    alert('Please fill in all required fields');
                    return false;
                }
            }
            return true;
        }

        function showReview() {
            const formDataObj = new FormData(form);
            const data = Object.fromEntries(formDataObj);

            // Get selected option texts to show "Online" instead of "online"
            const programSelect = form.querySelector('[name="program"]');
            const selectedProgramName = programSelect.options[programSelect.selectedIndex]?.text || data.program;

            const modeSelect = form.querySelector('[name="mode"]');
            const selectedMode = modeSelect.options[modeSelect.selectedIndex]?.text || data.mode;

            const expSelect = form.querySelector('[name="experience"]');
            const selectedExp = expSelect.options[expSelect.selectedIndex]?.text || data.experience;

            const reviewHTML = `
                    <h3 class="text-orange-600 text-xl font-bold mb-4">Review Your Information</h3>
                    <p class="mb-2"><strong>Name:</strong> ${data.firstName} ${data.lastName}</p>
                    <p class="mb-2"><strong>Email:</strong> ${data.email}</p>
                    <p class="mb-2"><strong>Phone:</strong> ${data.phone}</p>
                    <p class="mb-2"><strong>Program:</strong> ${selectedProgramName}</p>
                    <p class="mb-2"><strong>Learning Mode:</strong> ${selectedMode}</p>
                    <p class="mb-2"><strong>Experience Level:</strong> ${selectedExp}</p>
                `;

            document.getElementById('reviewInfo').innerHTML = reviewHTML;
        }

        nextBtn.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
            }
        });

        prevBtn.addEventListener('click', () => {
            currentStep--;
            showStep(currentStep);
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            if (!document.getElementById('terms').checked) {
                alert('Please agree to the Terms and Conditions');
                return;
            }

            // Hide form and show success message
            form.style.display = 'none';
            document.querySelector('.step').parentElement.style.display = 'none';
            successMessage.classList.remove('hidden');

            // Here you would typically send the data to your server
            console.log('Form submitted:', Object.fromEntries(new FormData(form)));
        });

        // Initialize
        showStep(1);
    </script>
@endpush