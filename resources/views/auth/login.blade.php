<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <a href="/" class="flex flex-col justify-center items-center">
            <img class="w-20 h-20" src='/images/example-app_teal_blue.png' alt="Example-App">
            <span class="text-lg text-secondary">{{ config('app.name') }}</span>
        </a>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label class="input-label" for="email">Email</label>
                <input 
                    id="email"
                    type="email" 
                    name="email" 
                    placeholder="name@email.com"
                    value="{{ old('email') }}" 
                    required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-2">
                <label class="input-label" for="password">Password</label>
                <input id="password"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button class="btn-primary-accent ml-2">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
