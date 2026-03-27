<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 font-medium">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 mb-1">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700 mb-1">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow" autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 rounded-lg transition-colors focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                {{ __('Update Security') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600 inline-flex items-center gap-1.5"
                ><i class="fas fa-check"></i> {{ __('Password Secured.') }}</p>
            @endif
        </div>
    </form>
</section>
