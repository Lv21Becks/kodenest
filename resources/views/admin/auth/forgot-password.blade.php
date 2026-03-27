@extends('layouts.admin-auth')

@section('title', 'Reset Password — KodeNest Admin')
@section('body_class', 'bg-white overflow-x-hidden')

@section('content')
<div class="min-h-screen w-full flex">
    {{-- Left Branding Panel --}}
    <div class="hidden lg:flex w-[45%] relative flex-col justify-center items-center bg-[#111111] overflow-hidden">
        <style>
            @keyframes blob { 0%,100% { transform: scale(1) translate(0,0); } 50% { transform: scale(1.05) translate(0,-20px); } }
            .animate-blob { animation: blob 8s infinite ease-in-out; }
            .animation-delay-2000 { animation-delay: 4s; }
        </style>
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-[20%] -right-[20%] w-[80%] h-[80%] bg-orange-600 rounded-full blur-[150px] opacity-40 animate-blob"></div>
            <div class="absolute -bottom-[20%] -left-[20%] w-[80%] h-[80%] bg-purple-600 rounded-full blur-[150px] opacity-40 animate-blob animation-delay-2000"></div>
        </div>
        <div class="relative z-10 flex flex-col items-center w-full px-12 pb-12">
            <a href="/"><img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest" class="h-28 w-auto drop-shadow-2xl hover:scale-105 transition-transform duration-500"></a>
            <div class="mt-10 text-center px-8">
                <h2 class="text-4xl font-bold text-white mb-4 tracking-tight">Account Recovery</h2>
                <p class="text-gray-400 text-lg font-light leading-relaxed">We'll send a secure reset link to your registered admin email address.</p>
            </div>
        </div>
    </div>

    {{-- Right Form Panel --}}
    <div class="w-full lg:w-[55%] flex flex-col justify-center items-center px-6 py-12 bg-gray-50 relative">
        <div class="absolute lg:hidden inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-[10%] -right-[10%] w-[50%] h-[50%] bg-orange-50 rounded-full blur-[120px] opacity-60"></div>
            <div class="absolute bottom-[10%] -left-[10%] w-[40%] h-[40%] bg-purple-50 rounded-full blur-[120px] opacity-60"></div>
        </div>

        <div class="w-full max-w-xl relative z-10">
            <div class="bg-white rounded-[2rem] p-12 lg:p-14 shadow-[0_20px_50px_rgba(0,0,0,0.08)] border border-gray-100 text-center">
                <div class="lg:hidden flex justify-center mb-8">
                    <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest" class="h-14 w-auto drop-shadow-md bg-[#111111] p-3 rounded-xl">
                </div>

                {{-- Icon --}}
                <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-50 border-2 border-orange-200 rounded-2xl mb-6">
                    <i class="fas fa-key text-orange-500 text-2xl"></i>
                </div>

                <h1 class="text-3xl font-extrabold text-gray-900 mb-3 tracking-tight">Forgot Password?</h1>
                <p class="text-gray-500 text-sm mb-8 font-medium leading-relaxed">
                    No problem. Enter your admin email address and we'll send you a secure password reset link.
                </p>

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl text-sm font-semibold text-green-700 flex items-center gap-3">
                        <i class="fas fa-check-circle text-green-500 text-lg"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="text-left space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Admin Email Address</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="block w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all text-gray-900 text-base"
                                placeholder="you@kodenest.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm font-medium" />
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-4 bg-gray-900 text-white font-bold text-lg rounded-2xl shadow-xl hover:bg-orange-600 hover:-translate-y-1 transition-all duration-300">
                            Send Reset Link
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('admin.login') }}" class="text-sm font-semibold text-gray-500 hover:text-orange-600 transition-colors">
                            <i class="fas fa-arrow-left mr-1.5"></i> Back to Login
                        </a>
                    </div>
                </form>
            </div>

            <p class="text-center text-sm text-gray-500 mt-8 font-medium">
                &copy; {{ date('Y') }} KodeNest ICT Academy.
            </p>
        </div>
    </div>
</div>
@endsection
