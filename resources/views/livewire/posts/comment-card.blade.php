<?php

use App\Models\Comment;
use Illuminate\Support\Str;
use Livewire\Volt\Component;
use TallStackUi\Traits\Interactions;

new class extends Component {

    use Interactions;

    protected $listeners = ['refreshComment' => '$refresh'];
    public $loggedInUser;
    public $comment;
    //    public $post;
    public $replyBody;

    public function bookmark(Comment $comment)
    {
        abort_if(
            ! auth()->check(),
            '404'
        );

        if (

            $comment->bookmarks->contains(
                'user_id',
                auth()->id()
            ))
        {
            return $comment->bookmarks()->where(
                'user_id',
                auth()->id()
            )->delete();
        }
        else
        {
            return $comment->bookmarks()->create(['user_id' => auth()->id()]);
        }

    }

    public function like(Comment $comment)
    {
        //        $this->skipRender();
        abort_if(
            ! auth()->check(),
            '404'
        );

        if (

            $comment->likes->contains(
                'user_id',
                auth()->id()
            ))
        {

            return $comment->likes()->where(
                'user_id',
                auth()->id()
            )->delete();

        }
        else
        {

            return $comment->likes()->create(['user_id' => auth()->id()]);
        }
    }

    public function addReply(Comment $comment)
    {

        $this->validate(
            ['replyBody' => 'required|min:3|max:255']
        );

        $comment->comments()->create(
            [
                'user_id' => auth()->id(),
                'body'    => $this->replyBody,
            ]
        );

        $this->replyBody = '';

        $this->banner()->close()->enter(seconds: 1)// Enter in 3 seconds
        ->leave(seconds: 5) // Leave in 10 seconds
        ->success('Your reply was added!')->send();

        $comment->post()->touch();

        //        return Redirect::back();
    }

} ?>


<div
    @cloak
    x-data="{ isOpen: false }">
    <div
        class="flex">
        <x-card-panel class="ml-6 sm:ml-8 md:ml-16 w-full p-2 {{$comment->commentable->solution_comment_id === $comment->id ? 'border-green-700' : ''}}">

            <div class="gap-4 p-4 sm:p-4 lg:p-6">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0">
                        <x-image-card
                            :user="$comment->user"
                            class="h-12 w-12"/>

                    </div>
                    <div class="w-full">
                        <a
                            href="{{$comment->user->route()}}"
                            class="flex gap-2 items-center">
                            <h3 class="text-sm font-semibold">{{$comment->user->name}}</h3>
                            @if($comment->user->name === $comment->commentable->user->name)
                                <span class="p-1 bg-primary rounded-full h-2.5 w-2.5"></span>
                            @endif
                        </a>
                        <p class="text-xs desc-text">Posted
                            at {{date_format($comment->created_at, 'g:i A')}}</p>
                    </div>
                    <div class="flex space-x-1 bg-white dark:bg-gray-900 items-center p-1 rounded">
                        @if(!$comment->commentable->solution_comment_id && $comment->commentable->user_id === $loggedInUser)
                            <x-primary-button
                                class="whitespace-nowrap"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'add-solution-comment-{{$comment->id}}')"
                            >{{ __('Mark as Solution') }}</x-primary-button>

                            <x-modal
                                name="add-solution-comment-{{$comment->id}}"
                                focusable>
                                <form
                                    wire:submit="$parent.markAsSolved({{$comment->id}})"
                                    class="p-6">

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete your account?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>


                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button>
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-danger-button
                                            x-on:click="$dispatch('close')"
                                            class="ms-3">
                                            {{ __('Add Solution') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        @endif
                    </div>
                    @if($comment->user_id !== auth()->id())
                        <x-bookmark :model="$comment"/>
                    @endif
                </div>

                <hr class="my-4"/>

                <p class="text-sm mt-4 text-gray-800 dark:text-gray-200">{{$comment->body}}</p>
                <div class="flex justify-between mt-2">

                    @auth
                        <button
                            type="button"
                            x-on:click="isOpen = !isOpen"
                            class="text-gray-800 dark:text-gray-900 dark:hover:text-white dark:bg-white dark:hover:bg-gray-900 text-sm  hover:bg-gray-200 font-semibold p-2 mt-2 rounded transition-colors duration-300">
                            Reply
                        </button>
                        <div class="flex items-center">
                            @if($comment->user_id !== auth()->id())
                                <x-like :model="$comment"/>
                            @endif
                            @if($comment->likes->count())

                                <p
                                    class="text-sm"
                                >{{$comment->likes->count() . ' ' . Str::plural('Person', $comment->likes->count())}}
                                    found this helpful
                                </p>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>

        </x-card-panel>
    </div>

    <div class="relative">

        <div class="absolute h-full w-[1px] bg-gray-300 left-8 sm:left-11 md:left-24"></div>
        @foreach($comment->comments as $commentOfComment)
            <x-card-panel class="ml-12 sm:ml-16 md:ml-32 mt-4 p-2">
                <div class=" gap-4 p-4 sm:p-4 lg:p-6">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <x-image-card
                                :user="$commentOfComment->user"
                                class="h-12 w-12"/>

                        </div>
                        <div>
                            <a
                                href="{{$commentOfComment->user->route()}}"
                                class="flex items-center gap-2">
                                <h3 class="text-sm font-semibold">{{$commentOfComment->user->name}}</h3>
                                @if($commentOfComment->user->name === $comment->commentable->user->name)
                                    <span class="p-1 bg-primary rounded-full h-2.5 w-2.5"></span>
                                @endif
                            </a>
                            <p class="text-xs desc-text">Posted
                                at {{date_format($commentOfComment->created_at, 'g:i A')}}</p>
                        </div>
                    </div>

                    <hr class="my-4"/>

                    <p class="text-sm mt-4 text-gray-800 dark:text-white">{{$commentOfComment->body}}</p>
                </div>
            </x-card-panel>
        @endforeach
    </div>

    {{--    Reply Form   --}}
    <div
        class="ml-12 sm:ml-16 md:ml-32 mt-4"
        x-show="isOpen"
    >
        @auth
            <form
                class="space-y-4"
                wire:submit="addReply({{$comment->id}})">
                <div class="mt-4">
                    <x-input-label
                        for="comment"
                        value="{{ __('Text') }}"
                        class="sr-only"/>


                    <textarea
                        class="w-full min-h-32 max-h-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-lg shadow-sm"
                        wire:model="replyBody"
                        name="replyBody"
                        id="replyBody"
                        type="text"
                        placeholder="{{ __('Add a reply...') }}"
                    ></textarea>

                    <x-input-error
                        :messages="$errors->get('replyBody')"
                        class="mt-2"/>
                </div>
                <x-primary-button>Add</x-primary-button>
            </form>
        @endauth
    </div>
</div>
