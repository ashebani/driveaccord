@php use Illuminate\Support\Str; @endphp
<div>
    <div class="max-w-7xl pb-12 mx-auto sm:px-6 lg:px-8 mt-4 grid">
        <div class="flex justify-between items-center">


            <div class="flex items-center gap-2">
                <input
                    wire:model.live="search"
                    type="text"
                    id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 pl-4 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Search..."
                >
                <div class="flex items-center ml-4 gap-2">

                    <input
                        type="checkbox"
                        wire:model.live="solvedOnly"
                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:bg-pink-500 checked:before:bg-pink-500 hover:before:opacity-10"
                    />
                    <p class="text-sm whitespace-nowrap">Solved Only</p>
                </div>
                {{--                                        Sort    --}}
                {{--                                    <x-sort/>--}}
                {{--                                        Solved Checkbox    --}}
                {{--                                    <x-solved-checkbox/>--}}
            </div>

            @auth
                <a
                    href="/posts/create"
                >
                    <x-primary-button>Create a post</x-primary-button>
                </a>
            @endauth


        </div>

        <x-panel class="mt-4 ext-gray-900 dark:text-gray-100 space-y-4">

            @forelse($posts as $post)
                <livewire:components.main-post-card
                    :post="$post"
                    wire:key="{{$post->id}}"/>
        @empty
            {{ __("No posts here yet.") }}
        @endforelse
        {{$posts->links()}}

    </div>
    </x-panel>
</div>
</div>
