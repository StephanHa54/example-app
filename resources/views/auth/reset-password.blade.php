<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <a href="/" class="flex flex-col justify-center items-center">
            <img class="w-20 h-20" src='/images/example-app_teal_blue.png' alt="Example-App">
            <span class="text-lg text-secondary">{{ config('app.name') }}</span>
        </a>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label class="input-label" for="email">Email</label>
                <input 
                    id="email"
                    type="email" 
                    name="email" 
                    value="{{ old('email', $request->email) }}" 
                    required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-2">
                <label class="input-label" for="password">Password</label>
                <input 
                    id="password"
                    type="password" 
                    name="password" 
                    required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-2">
                <label class="input-label" for="password_confirmation">Confirm Password</label>
                <input 
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation" 
                    required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn-primary-accent">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
