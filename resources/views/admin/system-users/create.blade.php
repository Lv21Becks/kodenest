@extends('layouts.admin')

@section('title', 'New Admin User')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Provision New System Admin</h2>
        <p class="text-sm text-gray-500 mt-1">Create an account and assign a role for backend system access.</p>
    </div>
    <a href="{{ route('admin.system-users.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">
        <i class="fas fa-arrow-left mr-1"></i> Back to Admins
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-3xl">
    <form action="{{ route('admin.system-users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Assigned Role</label>
            <select name="role" id="role" required class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow">
                @if(auth()->user()->hasRole(\App\Models\User::ROLE_SUPER_ADMIN))
                    <option value="{{ \App\Models\User::ROLE_SUPER_ADMIN }}" {{ old('role') == \App\Models\User::ROLE_SUPER_ADMIN ? 'selected' : '' }}>Super Admin - Full Control</option>
                @endif
                <option value="{{ \App\Models\User::ROLE_ADMIN }}" {{ old('role') == \App\Models\User::ROLE_ADMIN ? 'selected' : '' }}>Admin - Operations & Content (No System Access)</option>
                <option value="{{ \App\Models\User::ROLE_MODERATOR }}" {{ old('role') == \App\Models\User::ROLE_MODERATOR ? 'selected' : '' }}>Moderator - Applications & Read-Only Logic</option>
            </select>
            @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="py-4 border-t border-gray-100">
            <h4 class="text-sm font-bold text-gray-900 mb-4">Security Credentials</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Temporary Password</label>
                    <input type="password" name="password" id="password" required minlength="8"
                           class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8"
                           class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow">
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2"><i class="fas fa-info-circle mr-1"></i> Ensure the password is at least 8 characters long securely shared with the new administrator.</p>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.system-users.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300 rounded-lg transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 rounded-lg transition-colors focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                Provision Account
            </button>
        </div>
    </form>
</div>
@endsection
