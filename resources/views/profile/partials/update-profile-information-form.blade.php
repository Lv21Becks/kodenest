<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 font-medium">
            {{ __("Update your account's assigned profile information and contact email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">{{ __('Full Name') }}</label>
            <input id="name" name="name" type="text" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">{{ __('Email Address') }}</label>
            <input id="email" name="email" type="email" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-3 text-orange-600 font-medium bg-orange-50 p-2 rounded-lg border border-orange-100">
                        <i class="fas fa-exclamation-triangle mr-1"></i> {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="mt-1 font-bold underline hover:text-orange-800 transition-colors focus:outline-none">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-green-600">
                            <i class="fas fa-check-circle mr-1"></i> {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 rounded-lg transition-colors focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600 inline-flex items-center gap-1.5"
                ><i class="fas fa-check"></i> {{ __('Successfully Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
