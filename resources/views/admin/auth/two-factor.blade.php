@extends('layouts.admin-auth')

@section('title', 'Two-Factor Authentication - KodeNest')
@section('body_class', 'bg-white overflow-x-hidden')

@section('content')
    <div class="min-h-screen w-full flex">
        {{-- Left Side: Branding / Logo (Matches Login Seamlessly) --}}
        <div class="hidden lg:flex w-[45%] relative flex-col justify-center items-center bg-[#111111] overflow-hidden" 
             style="view-transition-name: auth-branding;">
            <style>
                @keyframes blob {
                    0% { transform: translate(0px, 0px) scale(1); }
                    50% { transform: translate(0px, -20px) scale(1.05); }
                    100% { transform: translate(0px, 0px) scale(1); }
                }
                .animate-blob { animation: blob 8s infinite ease-in-out; }
                .animation-delay-2000 { animation-delay: 4s; }
            </style>

            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
                <div class="absolute -top-[20%] -right-[20%] w-[80%] h-[80%] bg-orange-600 rounded-full blur-[150px] opacity-40 animate-blob"></div>
                <div class="absolute -bottom-[20%] -left-[20%] w-[80%] h-[80%] bg-purple-600 rounded-full blur-[150px] opacity-40 animate-blob animation-delay-2000"></div>
            </div>

            <div class="relative z-10 flex flex-col items-center animate-fade-in-up w-full px-12 pb-12">
                <a href="/">
                    <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest Logo"
                        class="h-28 w-auto drop-shadow-2xl hover:scale-105 transition-transform duration-500">
                </a>
                <div class="mt-10 text-center px-8">
                    <h2 class="text-4xl font-bold text-white mb-4 tracking-tight">Admin Portal</h2>
                    <p class="text-gray-400 text-lg font-light leading-relaxed">Secure access to manage the KodeNest learning platform, programs, and students.</p>
                </div>
            </div>
        </div>

        {{-- Right Side: 2FA Form (Slides in gracefully to replace the login box) --}}
        <div class="w-full lg:w-[55%] flex flex-col justify-center items-center px-6 py-12 bg-gray-50 relative h-full">
            
            <div class="absolute lg:hidden top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
                <div class="absolute -top-[10%] -right-[10%] w-[50%] h-[50%] bg-orange-50 rounded-full blur-[120px] opacity-60"></div>
                <div class="absolute bottom-[10%] -left-[10%] w-[40%] h-[40%] bg-purple-50 rounded-full blur-[120px] opacity-60"></div>
            </div>

            {{-- The Slide In / Fade In box --}}
            <div class="w-full max-w-xl relative z-10 animate-[slideInRight_0.6s_cubic-bezier(0.16,1,0.3,1)]">

                <style>
                    @keyframes slideInRight {
                        from { opacity: 0; transform: translateX(30px); }
                        to { opacity: 1; transform: translateX(0); }
                    }
                    .otp-input {
                        letter-spacing: 0.7em;
                    }
                    .otp-input::placeholder {
                        letter-spacing: 0.4em;
                    }
                </style>

                <div class="bg-white rounded-[2rem] p-10 lg:p-14 shadow-[0_20px_50px_rgba(0,0,0,0.08)] border border-gray-100 text-center relative overflow-hidden">
                    
                    {{-- Logo for Mobile only --}}
                    <div class="lg:hidden flex justify-center mb-8">
                        <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest Logo"
                            class="h-14 w-auto drop-shadow-md bg-[#111111] p-3 rounded-xl">
                    </div>

                    {{-- Header Icon --}}
                    <div class="mx-auto w-16 h-16 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center text-3xl mb-6 shadow-inner border border-orange-100">
                        <i class="fas fa-shield-halved"></i>
                    </div>

                    <h1 class="text-3xl font-extrabold text-gray-900 mb-2 tracking-tight">Identity Verification</h1>
                    <p class="text-gray-500 text-base mb-2 font-medium">A security code was sent to <span class="text-gray-800 font-bold">{{ \Illuminate\Support\Str::mask(auth()->user()->email, '*', 3, strpos(auth()->user()->email, '@') - 4) }}</span></p>

                    @if (session('status'))
                        <div class="my-4 flex items-center justify-center gap-2 text-green-700 bg-green-50 border border-green-200 rounded-xl px-4 py-3 font-semibold text-sm">
                            <i class="fas fa-check-circle"></i>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.2fa.store') }}" class="text-left mt-8 space-y-6">
                        @csrf

                        <div>
                            <label for="code" class="block text-sm font-bold text-gray-700 mb-2 text-center uppercase tracking-wider">Enter Code or Backup Code</label>
                            <input id="code" type="text" name="code"
                                required autofocus autocomplete="one-time-code"
                                class="otp-input block w-full px-5 py-5 rounded-2xl border-2 border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all text-gray-900 text-3xl font-bold text-center placeholder:text-gray-300 placeholder:font-normal"
                                placeholder="------">
                            @error('code')
                                <div class="mt-3 flex items-center justify-center gap-2 text-red-600 text-sm font-semibold bg-red-50 py-2 rounded-lg">
                                    <i class="fas fa-triangle-exclamation"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Trust device feature --}}
                        <div class="flex items-center justify-center pt-2">
                            <label for="trust_device" class="flex items-center gap-3 cursor-pointer group bg-gray-50 hover:bg-orange-50 px-4 py-2.5 rounded-xl border border-gray-100 transition-colors">
                                <div class="relative flex items-center justify-center">
                                    <input type="checkbox" id="trust_device" name="trust_device" value="1" class="peer sr-only">
                                    <div class="w-6 h-6 border-2 border-gray-300 rounded peer-checked:bg-orange-600 peer-checked:border-orange-600 transition-all flex items-center justify-center bg-white shadow-sm">
                                        <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gray-600 group-hover:text-orange-900 transition-colors">Trust this device for 30 days</span>
                            </label>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-5 bg-orange-600 text-white font-bold text-xl rounded-2xl shadow-[0_10px_20px_rgba(249,115,22,0.3)] hover:shadow-[0_15px_30px_rgba(249,115,22,0.4)] hover:-translate-y-1 hover:bg-orange-500 transition-all duration-300 flex items-center justify-center gap-3">
                                <i class="fas fa-unlock-keyhole"></i>
                                Authenticate
                            </button>
                        </div>
                    </form>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between pt-8 mt-6 border-t border-gray-100">
                        <form method="POST" action="{{ route('admin.2fa.resend') }}">
                            @csrf
                            <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-orange-600 transition-colors flex items-center gap-2 focus:outline-none bg-gray-50 hover:bg-orange-50 px-4 py-2 rounded-lg">
                                <i class="fas fa-rotate-right"></i>
                                Re-send Code
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-red-600 transition-colors flex items-center gap-2 focus:outline-none bg-gray-50 hover:bg-red-50 px-4 py-2 rounded-lg">
                                <i class="fas fa-right-from-bracket"></i>
                                Abort & Logout
                            </button>
                        </form>
                    </div>

                </div>

                <p class="text-center text-sm text-gray-400 mt-8 font-medium">
                    &copy; {{ date('Y') }} KodeNest Security.
                </p>
            </div>
        </div>
    </div>
@endsection
