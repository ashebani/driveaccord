<?php

namespace App\Livewire\Dashboard;

use App\Models\Bookmark;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $mostActivePosts;
    public $mostHelpfulPosts;
    public $latestPosts;

    public function render()
    {

        //        TODO: Solve bookmark query issue when saving or deleting
        $this->mostActivePosts = Post::query()->with('bookmarks')->select(
            [
                'id',
                'title',
                'created_at',
                'updated_at',
                'user_id',
            ]
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
        ])->take(10)->orderBy(
            'comments_count',
            'desc'
        )->get();

        $this->latestPosts = Post::with('bookmarks')->addSelect(
            [
                'user_name'  => User::select('name')->whereColumn(
                    'user_id',
                    'users.id'
                )->limit(1),
                'id_of_user' => User::select('id')->whereColumn(
                    'user_id',
                    'users.id'
                )->limit(1),
                'bookmark'   => Bookmark::select('id')->whereColumn(
                    'user_id',
                    'bookmarks.user_id'
                )->limit(1),
            ]
        )->withCount([
            'comments',
            'comments as contributions_count' => function ($query) {
                $query->select(DB::raw('count(distinct user_id)'));
            },
        ])->latest()->take(10)->get();

        $this->mostHelpfulPosts = Post::with(
            'bookmarks',
            'likes'
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
        ])->take(10)->get()->sortByDesc('total_likes');

        return view(
            'livewire.dashboard.index',
        //            [
        //                'latestPosts'      => $latestPosts,
        //                'mostActivePosts'  => $mostActivePosts,
        //                'mostHelpfulPosts' => $mostActivePosts,
        //                'latestPosts'      => $latestPosts,
        //                'mostActivePosts'  => $latestPosts,
        //                'mostHelpfulPosts'  => $mostHelpfulPosts,
        //            ]
        );
    }

}
