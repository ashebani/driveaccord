<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $solvedOnly;

    public function render()
    {
        $posts = Post::with([
            'user',
            'bookmarks',
        ])->when(
            $this->search,
            function (Builder $query) {
                //                $this->resetPage();
                $this->resetPage();
                $query->where(function ($query) {
                    $query->where(
                        'title',
                        'like',
                        '%'.$this->search.'%'
                    )->orWhere(
                        'description',
                        'like',
                        '%'.$this->search.'%'
                    );
                });
            }
        )->when(
            $this->solvedOnly,
            function (Builder $query) {
                $query->whereNotNull('solution_comment_id');
            }
        )->withCount([
            'comments',
            'comments as contributions_count' => function ($query) {
                $query->select(DB::raw('count(distinct user_id)'));
            },
        ])->paginate(10);

        //        dd($this->solvedOnly);

        return view(
            'livewire.posts.index',
            ['posts' => $posts]
        );
    }

    public function bookmark(Post $post)
    {
        abort_if(
            ! auth()->check(),
            '404'
        );

        if ($post->bookmarks->contains(
            'user_id',
            auth()->id()
        ))
        {
            return $post->bookmarks()->where(
                'user_id',
                auth()->id()
            )->delete();

        }
        else
        {
            return $post->bookmarks()->create(['user_id' => auth()->id()]);
        }

    }

}
