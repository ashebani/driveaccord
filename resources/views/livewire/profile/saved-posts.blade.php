<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;

new class extends Component {

    public $savedPosts;

    public function mount(): void
    {
        $userId           = auth()->id();
        $this->savedPosts = Post::with(
            'bookmarks',
            'user'
        )->whereHas(
            'bookmarks',
            function ($query) use ($userId) {
                $query->where(
                    'user_id',
                    $userId
                );
            }
        )->addSelect(
            [
                'user_name'  => User::select('name')->whereColumn(
                    'user_id',
                    'users.id'
                )->limit(1),
                'id_of_user' => User::select('id')->whereColumn(
                    'user_id',
                    'users.id'
                )->limit(1),
            ]
        )->withCount([
            'comments',
            'comments as contributions_count' => function ($query) {
                $query->select(DB::raw('count(distinct user_id)'));
            },
        ])->get();
    }

    public function bookmark(Post $post)
    {

        //		TODO: remove item from array when clicking
        abort_if(
            ! auth()->check(),
            '404'
        );

        if (

            $post->bookmarks->contains(
                'user_id',
                auth()->id()
            ))
        {

            $post->bookmarks()->where(
                'user_id',
                auth()->id()
            )->delete();

        }
        else
        {

            return $post->bookmarks()->create(['user_id' => auth()->id()]);
        }

    }

} ?>


<div
    class="w-full space-y-4">
    @forelse($savedPosts as $post)

        <livewire:components.post-card
            :post="$post"
            wire:key="{{$post->id}}"
        />

    @empty
        {{ __("No saved posts here yet, start adding now!") }}
        <a
            href="/posts"
            class="underline text-blue-600 hover:text-violet-900">Go to posts
        </a>
    @endforelse
</div>
{{--{{$savedPosts->links()}}--}}
