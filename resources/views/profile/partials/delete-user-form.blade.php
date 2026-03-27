<section class="space-y-6 relative z-10">
    <header>
        <h2 class="text-lg font-bold text-red-700">
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ __('Danger Zone: Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-red-600 font-medium">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-5 py-2.5 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
    >
        {{ __('Delete My Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 text-red-600 mb-4 mx-auto">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>

            <h2 class="text-xl font-bold text-gray-900 text-center mb-2">
                {{ __('Are you absolutely sure?') }}
            </h2>

            <p class="text-sm text-gray-500 text-center mb-6">
                {{ __('Once your account is deleted, all of its resources and data will be permanently wiped. Please enter your password to confirm you would like to proceed.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition-shadow text-center tracking-widest placeholder:tracking-normal"
                    placeholder="{{ __('Verify Password') }}"
                />
                @error('password', 'userDeletion')
                    <p class="mt-2 text-xs text-red-500 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex items-center justify-center gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    {{ __('Permanently Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
