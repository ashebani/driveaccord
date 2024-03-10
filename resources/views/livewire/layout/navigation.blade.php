<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect(
            '/',
            navigate: true
        );
    }
}; ?>

<nav
    x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a
                        href="/"
                        wire:navigate>
                        {{--                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>--}}

                        <img
                            src="{{asset('/img/logo.svg')}}"
                            {{--                            width="10"--}}
                            {{--                            height="10"--}}
                            class="w-28"
                            alt="">
                    </a>
                </div>

                <!-- Navigation Links -->

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                        wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link
                        :href="route('categories.index')"
                        :active="request()->routeIs('categories.index')"
                        wire:navigate>
                        {{ __('Makes') }}
                    </x-nav-link>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link
                        :href="route('posts.index')"
                        :active="request()->routeIs('posts.index')"
                        wire:navigate>
                        {{ __('Posts') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex gap-2">


                {{--                <div class="mt-5">--}}
                {{--                    <button--}}
                {{--                        x-on:click="darkMode = !darkMode"--}}
                {{--                        type="button"--}}
                {{--                        x-bind:class="darkMode ? 'bg-primary-500' : 'bg-gray-200'"--}}
                {{--                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"--}}
                {{--                        role="switch"--}}
                {{--                        aria-checked="false">--}}
                {{--                        <span class="sr-only">Dark mode toggle</span>--}}
                {{--                        <span--}}
                {{--                            x-bind:class="darkMode ? 'translate-x-5 bg-gray-700' : 'translate-x-0 bg-white'"--}}
                {{--                            class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out">--}}
                {{--                                <span--}}
                {{--                                    x-bind:class="darkMode ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"--}}
                {{--                                    class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"--}}
                {{--                                    aria-hidden="true">--}}
                {{--                                    <svg--}}
                {{--                                        xmlns="http://www.w3.org/2000/svg"--}}
                {{--                                        class="h-3 w-3 text-gray-400"--}}
                {{--                                        viewBox="0 0 20 20"--}}
                {{--                                        fill="currentColor">--}}
                {{--                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>--}}
                {{--                                    </svg>--}}
                {{--                                </span>--}}
                {{--                                <span--}}
                {{--                                    x-bind:class="darkMode ?  'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"--}}
                {{--                                    class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"--}}
                {{--                                    aria-hidden="true">--}}
                {{--                                    <svg--}}
                {{--                                        xmlns="http://www.w3.org/2000/svg"--}}
                {{--                                        class="h-3 w-3 text-white"--}}
                {{--                                        viewBox="0 0 20 20"--}}
                {{--                                        fill="currentColor">--}}
                {{--                                        <path--}}
                {{--                                            fill-rule="evenodd"--}}
                {{--                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"--}}
                {{--                                            clip-rule="evenodd"/>--}}
                {{--                                    </svg>--}}
                {{--                                </span>--}}
                {{--                            </span>--}}
                {{--                    </button>--}}
                {{--                </div>--}}

                <!-- Settings Dropdown -->
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown
                            align="right"
                            width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div
                                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                        x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name"></div>

                                    <div class="ms-1">
                                        <svg
                                            class="fill-current h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link
                                    :href="route('profile')"
                                    wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                @if(auth()->user()->email === 'a@a.com')
                                    <x-dropdown-link
                                        href="/admin"
                                    >
                                        {{ __('Admin Panel') }}
                                    </x-dropdown-link>
                                @endif
                                <!-- Authentication -->
                                <button
                                    wire:click="logout"
                                    class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                        <path
                            :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
                wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link
                :href="route('categories.index')"
                :active="request()->routeIs('categories.index')"
                wire:navigate>
                {{ __('Makes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link
                :href="route('posts.index')"
                :active="request()->routeIs('posts.index')"
                wire:navigate>
                {{ __('Posts') }}
            </x-responsive-nav-link>
        </div>

        @auth

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div
                        class="font-medium text-base text-gray-800 dark:text-gray-200"
                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                        x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link
                        :href="route('profile')"
                        wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button
                        wire:click="logout"
                        class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @endauth
    </div>
</nav>
