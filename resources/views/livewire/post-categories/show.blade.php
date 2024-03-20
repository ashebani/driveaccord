<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 pb-12 grid">

    <div class="flex items-center gap-2 max-w-xl">
        <x-primary-button
            class="whitespace-nowrap"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'filters-modal')"
        >{{ __('Add Filter') }}</x-primary-button>

        <x-modal
            name="filters-modal"
            focusable>
            <form
                wire:submit="filterPosts"
                class="p-6">

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="flex mt-4">

                    <input
                        wire:model="search"
                        type="text"
                        id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 pl-4 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Search Book..."
                    >
                    <div class="flex items-center ml-4 gap-2">

                        <input
                            type="checkbox"
                            wire:model="solvedOnly"
                            class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:bg-pink-500 checked:before:bg-pink-500 hover:before:opacity-10"
                        />
                        <p class="text-sm whitespace-nowrap">Solved Only</p>
                    </div>
                </div>


                <div class="mt-6 flex justify-end">
                    {{--                    <x-secondary-button>--}}
                    {{--                        {{ __('Filter') }}--}}
                    {{--                    </x-secondary-button>--}}

                    <x-danger-button x-on:click="$dispatch('close')">
                        Filter
                    </x-danger-button>

                </div>
            </form>
        </x-modal>


        {{--            --}}{{--    Search Bar    --}}
        {{--            <x-search/>--}}
        {{--            --}}{{--    Sort    --}}
        {{--            <x-sort/>--}}
        {{--            --}}{{--    Solved Checkbox    --}}
        {{--            <x-solved-checkbox/>--}}
    </div>

    <x-panel class="mt-4 text-gray-900 dark:text-gray-100 space-y-4">

        @forelse($posts as $post)
            <div
                wire:key="{{$post->id}}"
            >

                <x-posts.main-post-card
                    :post="$post"
                />
            </div>
        @empty
            {{ __("No posts here yet.") }}
        @endforelse
        {{$posts->links()}}

    </x-panel>
</div>
