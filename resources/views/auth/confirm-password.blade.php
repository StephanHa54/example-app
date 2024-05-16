<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <a href="/" class="flex flex-col justify-center items-center">
            <img class="w-20 h-20" src='/images/example-app_teal_blue.png' alt="Example-App">
            <span class="text-lg text-secondary">{{ config('app.name') }}</span>
        </a>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <label class="input-label" for="password">Password</label>
                <input 
                    id="password"
                    type="password"
                    name="password"
                    required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <button class="btn-primary-accent">
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
