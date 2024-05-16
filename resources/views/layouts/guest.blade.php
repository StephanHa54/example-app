<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        <link rel="shortcut icon" type="image/png" href="{{ URL::to('/') }}/images/example-app-favicon.png">

        <title>{{ config('app.name', 'Example App') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body class="font-sans bg-background text-gray-900 antialiased">
        <div id="app">
            <div class="min-h-screen flex flex-col">

                <!-- Top of Page Navigation -->
                <nav class="fixed min-w-full bg-primary py-2 px-16 shadow-md z-10">
                    <div class="flex justify-between items-center">
                        <a class="uppercase no-underline flex items-center" href="{{ url('/') }}">
                            <img class="object-scale-down h-12 w-12" src='/images/example-app_white_blue.png' alt="example-app">
                            <h2 class="text-4xl text-white font-normal pl-2">{{ config('app.name') }}</h2>
                        </a>
                        <div class="flex items-center">
                            <div class="hidden lg:flex flex-auto justify-end">
                                <ul class="flex list-reset justify-end items-center font-thin pr-4">
                                </ul>
                                @if (Route::has('login'))
                                    <div class="-mx-3 flex flex-1 justify-end">
                                        @auth
                                            <a href="{{ url('/dashboard') }}"class="btn-ghost-accent">
                                                Dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn-ghost-accent mr-2">
                                                Log in
                                            </a>
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="btn-ghost-accent">
                                                    Register
                                                </a>
                                            @endif
                                        @endauth
                                    </div>
                                @endif
                            </div>
                            <div class="flex justify-center lg:hidden">
                                <top-nav-menu>
                                    <template v-slot:deactivated>
                                        <span class="text-white text-4xl">=</span>
                                    </template>
                                    <template v-slot:activated>
                                        <span class="text-white text-4xl">X</span>
                                    </template>
                                    <template v-slot:main>
                                        <div class="bg-white mt-2 w-screen shadow-lg -ml-16 rounded-lg p-3">
                                            @if (Route::has('login'))
                                                <div class="flex flex-col w-28">
                                                    @auth
                                                        <a href="{{ url('/dashboard') }}"class="btn-primary-accent">
                                                            Dashboard
                                                        </a>
                                                    @else
                                                        <a href="{{ route('login') }}" class="btn-primary-accent my-2">
                                                            Log in
                                                        </a>
                                                        @if (Route::has('register'))
                                                            <a href="{{ route('register') }}" class="btn-primary-accent">
                                                                Register
                                                            </a>
                                                        @endif
                                                    @endauth
                                                </div>
                                            @endif
                                        </div>
                                    </template>
                                </top-nav-menu>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <main class="min-w-full flex flex-col justify-center items-center pt-16">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
