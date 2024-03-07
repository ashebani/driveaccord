<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;

new class extends Component {
    public $myPosts;
    public string $body;

    public function mount(): void
    {
        $this->myPosts = auth()->user()->posts()->withCount([
            'comments',
            'comments as contributions_count' => function ($query) {
                $query->select(DB::raw('count(distinct user_id)'));
            },
        ])->get();
    }

    public function delete(Post $post)
    {
        abort_if(
            $post->user_id !== auth()->id(),
            '401'
        );

        $post->delete();

        return redirect('/profile');
    }

    public function markAsSolved(Post $post)
    {
        abort_if(
            $post->user_id !== auth()->id(),
            '401'
        );

        $comment = $post->comments()->create(
            [
                'user_id' => auth()->id(),
                'body'    => $this->body
            ]
        );
        $post->update(['solution_comment_id' => $comment->id]);

        return redirect('/posts/'.$post->id);
    }

} ?>


<div class="w-full space-y-4">
    @forelse($myPosts as $post)

        <article
            x-cloak
            wire:key="{{$post->id}}"
        >
            <x-card-panel class="p-4 pt-5 sm:p-4 {{$post->solution_comment_id ? 'border-green-700 dark:border-green-700 dark:border-2' : ''}}">
                <div class="flex justify-between items-start gap-4">


                    <div class="flex items-start gap-4">

                        <div>
                            <h3 class="font-medium text-sm sm:text-lg lg:text-xl overflow-x-hidden text-ellipsis ">
                                <a
                                    wire:navigate
                                    href="/posts/{{$post->id}}"
                                    class="hover:underline dark:text-white">{{$post->title}}
                                </a>
                            </h3>


                            <div class="mt-2 sm:flex sm:items-center sm:gap-2">
                                <div class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
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

                                    <p class="text-xs desc-text">{{$post->comments_count . ' ' . Str::plural('Comment', $post->comments_count)}}</p>
                                </div>
                                <div class="flex items-center gap-1 justify-start text-gray-500 dark:text-gray-400">
                                    <svg
                                        width="1.5em"
                                        height="1.5em"
                                        class="fill-gray-500 dark:fill-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 32 32">
                                        <path

                                            d="M 16 8 C 13.250421 8 11 10.250421 11 13 C 11 14.515649 11.706976 15.862268 12.78125 16.78125 C 11.713282 17.341324 10.782864 18.182903 10.125 19.1875 C 9.7680325 18.670371 9.3015664 18.196343 8.78125 17.84375 C 9.5247394 17.116062 10 16.114227 10 15 C 10 12.802706 8.1972944 11 6 11 C 3.8027056 11 2 12.802706 2 15 C 2 16.114227 2.4752606 17.116062 3.21875 17.84375 C 1.8879616 18.745561 1 20.284091 1 22 L 3 22 C 3 20.345455 4.3454545 19 6 19 C 7.6545455 19 9 20.345455 9 22 L 9 23 L 11 23 C 11 20.245455 13.245455 18 16 18 C 18.754545 18 21 20.245455 21 23 L 23 23 L 23 22 C 23 20.345455 24.345455 19 26 19 C 27.654545 19 29 20.345455 29 22 L 31 22 C 31 20.284091 30.112038 18.745561 28.78125 17.84375 C 29.524739 17.116062 30 16.114227 30 15 C 30 12.802706 28.197294 11 26 11 C 23.802706 11 22 12.802706 22 15 C 22 16.114227 22.475261 17.116062 23.21875 17.84375 C 22.698434 18.196343 22.231967 18.670371 21.875 19.1875 C 21.217136 18.182903 20.286718 17.341324 19.21875 16.78125 C 20.293024 15.862268 21 14.515649 21 13 C 21 10.250421 18.749579 8 16 8 z M 16 10 C 17.668699 10 19 11.331301 19 13 C 19 14.668699 17.668699 16 16 16 C 14.331301 16 13 14.668699 13 13 C 13 11.331301 14.331301 10 16 10 z M 6 13 C 7.116414 13 8 13.883586 8 15 C 8 16.116414 7.116414 17 6 17 C 4.883586 17 4 16.116414 4 15 C 4 13.883586 4.883586 13 6 13 z M 26 13 C 27.116414 13 28 13.883586 28 15 C 28 16.116414 27.116414 17 26 17 C 24.883586 17 24 16.116414 24 15 C 24 13.883586 24.883586 13 26 13 z"

                                        />
                                    </svg>


                                    <p class="text-xs desc-text">{{$post->contributions_count . ' ' . Str::plural('Contribution', $post->contributions_count)}}</p>

                                    <span
                                        class="hidden sm:block"
                                        aria-hidden="true">
                                    &middot;
                                </span>
                                    <p class="text-xs text-right justify-self-end desc-text">{{$post->created_at->diffForHumans()}}</p>
                                </div>


                            </div>
                        </div>

                    </div>

                    <div class="text-right flex gap-2 justify-end">

                        <div class="flex space-x-1 bg-white dark:bg-transparent items-center p-1 rounded">
                            @if(!$post->solution_comment_id)
                                <x-primary-button
                                    class="whitespace-nowrap"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'add-solution-comment-{{$post->id}}')"
                                >{{ __('Add Solution') }}</x-primary-button>

                                <x-modal
                                    name="add-solution-comment-{{$post->id}}"
                                    :show="$errors->isNotEmpty()"
                                    focusable>
                                    <form
                                        wire:submit="markAsSolved({{$post->id}})"
                                        class="p-6 text-left">

                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Are you sure you want to delete your account?') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                        </p>

                                        <div class="mt-6">
                                            <x-input-label
                                                for="body"
                                                value="{{ __('Comment') }}"
                                                class="sr-only"/>

                                            <x-text-input
                                                wire:model="body"
                                                id="body"
                                                name="body"
                                                type="text"
                                                class="mt-1 block w-3/4"
                                                placeholder="{{ __('Add your solution...') }}"
                                            />

                                            <x-input-error
                                                :messages="$errors->get('body')"
                                                class="mt-2"/>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>

                                            <x-primary-button class="ms-3 bg-primary">
                                                {{ __('Add Solution') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </x-modal>
                            @endif
                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-post-deletion-{{$post->id}}')"
                            >{{ __('Delete') }}</x-danger-button>

                            <x-modal
                                name="confirm-post-deletion-{{$post->id}}"
                                :show="$errors->isNotEmpty()"
                                focusable>
                                <form
                                    wire:submit="delete({{$post->id}})"
                                    class="p-6">

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete your account?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ms-3">
                                            {{ __('Delete Post') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>


                        </div>


                    </div>
                </div>

            </x-card-panel>

        </article>

    @empty
        {{ __("No saved posts here yet, start adding now!") }}
        <a
            href="/posts/create"
            class="underline text-blue-600 hover:text-violet-900">Create a new post
        </a>
    @endforelse
</div>
{{--{{$savedPosts->links()}}--}}


