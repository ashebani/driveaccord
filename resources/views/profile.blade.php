<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="grid"
                x-data="{ tab: window.location.hash ? window.location.hash : '#account' }">

                <div class="mb-4 flex gap-4 p-2 bg-white dark:bg-gray-800 rounded-lg shadow-md max-w-lg w-full justify-self-center">
                    <button
                        @click="tab = '#account'"
                        :class="{ 'bg-primary dark:bg-primary-700 text-gray-800 dark:text-white ': tab === '#account' }"
                        class="flex-1 py-2 px-4 rounded-md dark:text-gray-400 focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                        {{__("Account")}}
                    </button>
                    <button
                        @click="tab = '#my-posts'"
                        :class="{ 'bg-primary dark:bg-primary-700 text-gray-800 dark:text-white ': tab === '#my-posts' }"
                        class="flex-1 py-2 px-4 rounded-md dark:text-gray-400 focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                        {{__("My Posts")}}
                    </button>
                    <button
                        @click="tab = '#saved-posts'"
                        :class="{ 'bg-primary dark:bg-primary-700 text-gray-800 dark:text-white ': tab === '#saved-posts' }"
                        class="flex-1 py-2 px-4 rounded-md dark:text-gray-400 focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                        {{__("Saved Posts")}}
                    </button>
                </div>

                {{--Account Settings--}}
                <div
                    x-show="tab=='#account'"
                    class="space-y-6 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mt-4">

                    <x-panel class="p-4 sm:p-8">
                        <div class="max-w-xl">
                            <livewire:profile.update-profile-information-form/>
                        </div>
                    </x-panel>

                    <x-panel class="p-4 sm:p-8">
                        <div class="max-w-xl">
                            <livewire:profile.update-password-form/>
                        </div>
                    </x-panel>

                    <x-panel class="p-4 sm:p-8">
                        <div class="max-w-xl">
                            <livewire:profile.delete-user-form/>
                        </div>
                    </x-panel>

                </div>

                {{--My Posts--}}
                <div
                    x-show="tab == '#my-posts'"
                    class="space-y-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">

                    <x-panel>
                        <livewire:profile.my-posts/>
                    </x-panel>


                </div>

                {{--Saved Posts--}}
                <div
                    x-show="tab == '#saved-posts'"
                    class="space-y-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">

                    <x-panel>
                        <livewire:profile.saved-posts/>
                    </x-panel>

                </div>


            </div>
        </div>
    </div>
</x-app-layout>
