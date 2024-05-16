<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <a href="/" class="flex flex-col justify-center items-center">
            <img class="w-20 h-20" src='/images/example-app_teal_blue.png' alt="Example-App">
            <span class="text-lg text-secondary">{{ config('app.name') }}</span>
        </a>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div>
                <label class="input-label" for="first_name">First Name</label>
                <input  
                    id="first_name" 
                    type="text" 
                    name="first_name" 
                    value="{{ old('first_name') }}"
                    required autofocus autocomplete="first_name">
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <!-- Last Name -->
            <div class="mt-2">
                <label class="input-label" for="last_name">Last Name</label>
                <input
                    id="last_name"
                    type="text" 
                    name="last_name" 
                    value="{{ old('last_name') }}" 
                    required autofocus autocomplete="last_name">
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-2">
                <label class="input-label" for="email">Email</lable>
                <input 
                    id="email"
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="name@email.com"
                    required autocomplete="username">
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
                <a class="underline text-sm text-gray-600 hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button class="btn-primary-accent ml-2">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
