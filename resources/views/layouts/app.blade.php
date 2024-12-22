<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('dark-mode') ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        {{ $header }}
                        <!-- Dark Mode Toggle Button -->
                        <button id="dark-mode-toggle"
                                class="p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:outline-none">
                            🌙 / ☀️
                        </button>
                        <a href="{{ route('notifications') }}">
                            Notifications <span class="bg-red-500 text-white px-2 py-1 rounded">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>


                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toggleButton = document.querySelector('#dark-mode-toggle');

                // Load stored theme preference
                if (localStorage.getItem('theme') === 'dark') {
                    document.documentElement.classList.add('dark');
                }

                toggleButton.addEventListener('click', function () {
                    document.documentElement.classList.toggle('dark');
                    const theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
                    localStorage.setItem('theme', theme);
                });
            });
        </script>
    </body>
</html>
