@extends('layouts.admin')

@section('title', 'Your Profile')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Account Settings</h2>
        <p class="text-sm text-gray-500 mt-1">Manage your administrative credentials and security preferences.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Quick Stats Profile Summary Panel -->
    <div class="col-span-1 border border-gray-100 bg-white rounded-xl shadow-sm p-6 flex flex-col items-center">
        <div class="h-24 w-24 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex justify-center items-center text-white font-bold text-3xl shadow-md ring-4 ring-orange-50 mb-4">
            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
        </div>
        <h3 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
        <p class="text-gray-500 text-sm mb-4">{{ Auth::user()->email }}</p>

        @if(auth()->user()->hasRole(\App\Models\User::ROLE_SUPER_ADMIN))
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200">
                <i class="fas fa-crown"></i> Super Admin
            </span>
        @elseif(auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN))
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                <i class="fas fa-user-shield"></i> Admin
            </span>
        @else
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <i class="fas fa-user-check"></i> Moderator
            </span>
        @endif
        
        <div class="mt-6 w-full pt-6 border-t border-gray-100 text-left">
            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Security Status</h4>
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600">Email OTP 2FA</span>
                <span class="text-green-600 font-bold"><i class="fas fa-check-circle"></i> Active</span>
            </div>
        </div>
    </div>

    <!-- Edit Forms -->
    <div class="col-span-1 lg:col-span-2 space-y-6">
        
        <!-- Profile Info -->
        <div class="p-6 bg-white shadow-sm rounded-xl border border-gray-100">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Password Update -->
        <div class="p-6 bg-white shadow-sm rounded-xl border border-gray-100">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Danger Zone -->
        @if(auth()->user()->hasRole(\App\Models\User::ROLE_SUPER_ADMIN))
        <div class="p-6 bg-white shadow-sm rounded-xl border border-red-200 ring-1 ring-red-50 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-red-50 rounded-bl-full -z-10"></div>
            @include('profile.partials.delete-user-form')
        </div>
        @endif

    </div>
</div>
@endsection
