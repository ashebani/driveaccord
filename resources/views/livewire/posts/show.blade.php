<div class="py-12">
    <div class="max-w-7xl mx-auto px-0 sm:px-6 lg:px-8">
        <x-panel class="text-gray-900 dark:text-gray-100 space-y-4">
            {{-- Main Post --}}
            <x-card-panel class="">
                <div class="grid items-start gap-4 p-4 sm:p-6 lg:p-8">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <x-image-card
                                :user="$post->user"
                                class="h-12 w-12 md:h-12 md:w-12"/>

                            <div class="w-full">
                                <p class="text-md md:text-lg flex gap-2 items-center">
                                    <a href="{{$post->user->route()}}">{{$post->user->name}}</a>
                                    <span
                                        class="p-1 bg-primary rounded-full h-2.5 w-2.5"></span>
                                </p>

                                <p class="text-gray-500 text-xs md:text-sm">
                                    Joined {{date_format($post->user->created_at, 'd M Y')}}
                                </p>
                            </div>
                        </div>
                        {{--                            <x-post.delete-form :post="$post"/>--}}

                    </div>
                    <div class="grid">
                        <div class="flex items-center justify-between">
                            <h2 class="font-medium text-lg md:text-2xl">
                                {{$post->title}}
                            </h2>

                        </div>

                        <div class="sm:flex sm:items-center sm:justify-between mt-2">
                            <div class=" sm:flex sm:items-center sm:gap-2">
                                <div class="flex items-center gap-1 text-gray-500">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
                                        />
                                    </svg>

                                    <p class="text-xs desc-text">{{$comments->total() . ' ' . Str::plural('Comment', $comments->total())}}</p>
                                </div>

                                <span
                                    class="hidden sm:block"
                                    aria-hidden="true">&middot;</span>

                                <p class="hidden sm:block sm:text-xs desc-text">
                                    Posted at
                                    <span>{{date_format($post->created_at,'d M Y' )}}</span>
                                </p>
                            </div>

                            <p class="hidden sm:block sm:text-xs desc-text sm:text-right sm:justify-self-end">
                                Last Contribution {{$post->updated_at->diffForHumans()}}
                            </p>

                        </div>

                        <hr class="my-4 dark:border-gray-400"/>

                        <p class="text-md text-gray-700 dark:text-white">
                            {!!  $post->description !!}
                        </p>

                    </div>
                    <div class="flex items-center justify-between flex-row-reverse">

                        @auth
                            <div class="text-right flex gap-2 justify-end">
                                <div class="flex space-x-1 items-center p-1 rounded">
                                    <!-- Bookmark Button -->
                                    @if($post->user_id !== auth()->id())
                                        <x-bookmark
                                            :model="$post"
                                        />
                                        <x-like
                                            :model="$post"
                                        />
                                    @endif

                                </div>


                            </div>
                        @endauth

                    </div>
                </div>
            </x-card-panel>
            {{--    Replies     --}}
            <article
                wire:ignore.self
                class="space-y-4"
            >
                @forelse($comments as $comment)
                    <livewire:posts.comment-card
                        :postUser="$post->user"
                        wire:key="{{$comment->id}}"
                        :comment="$comment"/>
                @empty
                @endforelse
                @auth
                    {{--    TODO: check message wire:model if it intercects with the reply one  --}}
                    <form
                        class="space-y-4"
                        wire:submit="addComment()">
                        <div class="mt-4">
                            <x-input-label
                                for="comment"
                                value="{{ __('Text') }}"
                                class="sr-only"/>

                            <textarea
                                class="w-full min-h-32 max-h-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-lg shadow-sm"
                                wire:model="comment"
                                name="comment"
                                id="comment"
                                type="text"
                                placeholder="{{ __('Add a comment...') }}"
                            ></textarea>

                            <x-input-error
                                :messages="$errors->get('comment')"
                                class="mt-2"/>
                        </div>

                        <x-primary-button
                            class="disabled:opacity-25"
                            wire:loading.attr="disabled">
                            <span wire:loading>Loading...</span>
                            <span wire:loading.remove>Add</span>
                        </x-primary-button>
                    </form>
                @endauth
                {{$comments->links()}}
            </article>

        </x-panel>
    </div>
</div>


