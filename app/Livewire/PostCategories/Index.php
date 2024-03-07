<?php

namespace App\Livewire\PostCategories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::withCount([
            'posts',
            'posts as post_contributers' => function ($query) {
                $query->select(DB::raw('count(distinct user_id)'));
            },
        ])->addSelect(
            [
                'post_last_updated' => Post::select('updated_at')->whereColumn(
                    'user_id',
                    'categories.id'
                )->latest()->take(1),
            ]
        )->get();
    }

    public function render()
    {
        return view('livewire.post-categories.index');
    }
}
