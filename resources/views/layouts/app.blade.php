<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    {{app()->getLocale() === 'ar' ?     "dir=rtl"
 : ''
    }}
>
<head>
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"/>

    <!-- Scripts -->
    <tallstackui:script/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="font-sans antialiased"
    {{--    x-data="{ darkMode: null}"--}}
    {{--    x-init="--}}
    {{--let darkMode = localStorage.getItem('darkMode'); // Get the value without parsing--}}
    {{--if (darkMode) {--}}
    {{--  try {--}}
    {{--    darkMode = JSON.parse(darkMode); // Parse only if a value exists--}}
    {{--  } catch (error) {--}}
    {{--    // Handle potential parsing errors (optional)--}}
    {{--    console.error('Error parsing darkMode:', error);--}}
    {{--    darkMode = false; // Set default if parsing fails--}}
    {{--  }--}}
    {{--} else {--}}
    {{--  darkMode = false; // Set default if no value exists--}}
    {{--}--}}
    {{--    if (darkMode) {--}}
    {{--        document.body.classList.add('dark');--}}
    {{--    } else {--}}
    {{--        document.body.classList.remove('dark');--}}
    {{--    }--}}
    {{--    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))--}}
    {{--    $watch('darkMode', value => console.log(value));"--}}
    {{--    x-cloak--}}

>
<div
    class="fixed top-0 w-screen z-50"
    {{--    x-bind:class="{'dark' : darkMode === true}"--}}
>
    <x-tsui-banner wire/>
</div>
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <livewire:layout.navigation/>

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
<x-footer/>
</body>
</html>
