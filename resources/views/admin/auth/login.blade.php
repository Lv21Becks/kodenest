@extends('layouts.admin-auth')

@section('title', 'Admin Login - KodeNest')
@section('body_class', 'bg-white overflow-x-hidden')

@section('content')
    <div class="min-h-screen w-full flex">
        {{-- Left Side: Branding / Logo (Hidden on smaller screens) --}}
        <div class="hidden lg:flex w-[45%] relative flex-col justify-center items-center bg-[#111111] overflow-hidden">
            {{-- Custom Blob Animation Style --}}
            <style>
                @keyframes blob {
                    0% {
                        transform: translate(0px, 0px) scale(1);
                    }
                    50% {
                        transform: translate(0px, -20px) scale(1.05);
                    }
                    100% {
                        transform: translate(0px, 0px) scale(1);
                    }
                }

                .animate-blob {
                    animation: blob 8s infinite ease-in-out;
                }

                .animation-delay-2000 {
                    animation-delay: 4s;
                }
            </style>

            {{-- Animated Decorative Blobs --}}
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
                <div
                    class="absolute -top-[20%] -right-[20%] w-[80%] h-[80%] bg-orange-600 rounded-full blur-[150px] opacity-40 animate-blob">
                </div>
                <div
                    class="absolute -bottom-[20%] -left-[20%] w-[80%] h-[80%] bg-purple-600 rounded-full blur-[150px] opacity-40 animate-blob animation-delay-2000">
                </div>
            </div>

            {{-- Vertically centered (removed mb-32) --}}
            <div class="relative z-10 flex flex-col items-center animate-fade-in-up w-full px-12 pb-12">
                <a href="/">
                    <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest Logo"
                        class="h-28 w-auto drop-shadow-2xl hover:scale-105 transition-transform duration-500">
                </a>
                <div class="mt-10 text-center px-8">
                    <h2 class="text-4xl font-bold text-white mb-4 tracking-tight">Admin Portal</h2>
                    <p class="text-gray-400 text-lg font-light leading-relaxed">Secure access to manage the KodeNest
                        learning platform, programs, and students.</p>
                </div>
            </div>
        </div>

        {{-- Right Side: Login Form --}}
        <div class="w-full lg:w-[55%] flex flex-col justify-center items-center px-6 py-12 bg-gray-50 relative h-full">

            {{-- Decorative Blobs for Mobile (since left side is hidden) --}}
            <div class="absolute lg:hidden top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
                <div
                    class="absolute -top-[10%] -right-[10%] w-[50%] h-[50%] bg-orange-50 rounded-full blur-[120px] opacity-60">
                </div>
                <div
                    class="absolute bottom-[10%] -left-[10%] w-[40%] h-[40%] bg-purple-50 rounded-full blur-[120px] opacity-60">
                </div>
            </div>

            <div class="w-full max-w-xl relative z-10 animate-fade-in-up">

                <div
                    class="bg-white rounded-[2rem] p-12 lg:p-14 shadow-[0_20px_50px_rgba(0,0,0,0.08)] border border-gray-100 text-center relative overflow-hidden">
                    {{-- Logo for Mobile only --}}
                    <div class="lg:hidden flex justify-center mb-8">
                        <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest Logo"
                            class="h-14 w-auto drop-shadow-md bg-[#111111] p-3 rounded-xl">
                    </div>

                    <h1 class="text-4xl font-extrabold text-gray-900 mb-3 tracking-tight">Welcome Back</h1>
                    <p class="text-gray-500 text-base mb-10 font-medium">Sign in to your admin account</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6" :status="session('status')" />

                    <form method="POST" action="{{ route('admin.login') }}" class="text-left space-y-7">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <div class="relative">
                                <i
                                    class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                                <input id="email"
                                    class="block w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all text-gray-900 text-lg"
                                    type="email" name="email" value="{{ old('email') }}" required autofocus
                                    autocomplete="username" placeholder="admin@kodenest.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')"
                                class="mt-2 text-red-500 text-sm font-medium" />
                        </div>

                        <!-- Password -->
                        <div x-data="{ show: false }">
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                            <div class="relative group flex items-center">
                                <i class="fas fa-lock absolute left-4 text-gray-400 text-lg"></i>
                                <input id="password"
                                    class="block w-full pl-12 pr-12 py-4 rounded-2xl border border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all text-gray-900 text-lg"
                                    :type="show ? 'text' : 'password'" name="password" required
                                    autocomplete="current-password" placeholder="••••••••" />

                                <button type="button" @click="show = !show"
                                    class="absolute right-4 text-gray-400 hover:text-orange-500 transition-colors focus:outline-none focus:text-orange-500 text-lg flex items-center justify-center">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')"
                                class="mt-2 text-red-500 text-sm font-medium" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between pt-2">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                                <input id="remember_me" type="checkbox"
                                    class="w-5 h-5 rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500 transition-colors"
                                    name="remember">
                                <span
                                    class="ms-3 text-sm text-gray-600 font-bold group-hover:text-gray-900 transition-colors">Remember
                                    me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm font-bold text-gray-600 hover:text-orange-600 transition-colors"
                                    href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <div class="pt-6">
                            <button type="submit"
                                class="w-full py-5 bg-gray-900 text-white font-bold text-xl rounded-2xl shadow-xl hover:shadow-2xl hover:bg-orange-600 hover:-translate-y-1 transition-all duration-300">
                                Log In
                            </button>
                        </div>
                    </form>
                </div>

                <p class="text-center text-sm text-gray-500 mt-10 font-medium">
                    &copy; {{ date('Y') }} KodeNest ICT Academy.
                </p>
            </div>
        </div>
    </div>
@endsection