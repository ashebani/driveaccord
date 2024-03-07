<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{

    public $user;

    public function mount(User $user)
    {

        $this->user = $user;
        //                $countOfSolvedPosts = Post::whereHas(
        //                    'comments',
        //                    function ($query) use ($user) {
        //                        $query->whereIn(
        //                            'solution_comment_id',
        //                            Comment::all()->where(
        //                                'user_id',
        //                                $user->id
        //                            )->pluck('id')
        //                        );
        //                    }
        //                )->get()->count();
    }

    public function render()
    {

        return view(
            'livewire.users.show',
            ['count']
        );
    }
}
