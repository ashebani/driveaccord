<?php

namespace App\Livewire\PostCategories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{

    use WithPagination;

    public $category;
    public $search = '';
    public $solvedOnly;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {

        //                $posts = $this->category->posts()->with(
        //                    [
        //                        'comments',
        //                        'user',
        //                    ]
        //                );

        $posts = $this->category->posts()->with([
            'user',
        ])->when(
            $this->search,
            function (Builder $query) {
                $query->where(function ($query) {
                    $this->resetPage();
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
        ]);

        return view(
            'livewire.post-categories.show',
            ['posts' => $posts->paginate(10)]
        );
    }

    public function filterPosts()
    {
        $this->dispatch('$render');
    }
}
