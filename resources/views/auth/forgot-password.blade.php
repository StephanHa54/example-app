<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <a href="/" class="flex flex-col justify-center items-center">
            <img class="w-20 h-20" src='/images/example-app_teal_blue.png' alt="Example-App">
            <span class="text-lg text-secondary">{{ config('app.name') }}</span>
        </a>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label class="input-label" for="email">Email</lable>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent" href="{{ route('login') }}">
                    {{ __('Log in') }}
                </a>

                <button class="btn-primary-accent ml-2">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
