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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-background text-gray-900 antialiased">
        <div id="app">
            <div class="min-h-screen flex flex-col">

                <!-- Top of Page Navigation -->
                <nav class="fixed min-w-full bg-primary py-2 px-16 shadow-md z-10">
                    <div class="flex justify-between items-center">
                        <a class="uppercase no-underline flex items-center" href="{{ url('/') }}">
                            <img class="object-scale-down h-12 w-12" src='/images/example-app_white_blue.png' alt="example-app">
                            <h2 class="text-4xl text-white font-normal pl-2">{{ config('app.name', 'Example-App') }}</h2>
                        </a>
                        <div class="flex items-center">
                            <div class="flex justify-center">
                                <top-nav-menu>
                                    <template v-slot:deactivated>
                                        <div class="flex items-center text-white">
                                            <img 
                                            class="rounded-full w-12 h-12 mr-3"
                                            src="{{Auth::user()->avatar_url}}">
                                            <span class="pr-1 text-lg">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-slot:activated>
                                        <div class="flex items-center text-white">
                                            <img 
                                            class="rounded-full w-12 h-12 mr-3"
                                            src="{{Auth::user()->avatar_url}}">
                                            <span class="pr-1 text-lg">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-slot:main>
                                        <div class="bg-white mt-2 w-screen shadow-lg -ml-28 rounded-lg p-3">
                                            <div class=" text-gray-400">
                                                {{Auth::user()->email}}
                                            </div>
                                            
                                            <a href="/profile"
                                                class="top-nav-link">
                                                {{ __('Profile') }}
                                            </a>

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <a href="route('logout')"
                                                    class="top-nav-link"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </a>
                                            </form>
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
