<?php

namespace App\Livewire\Posts;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Show extends Component
{
    use WithPagination, Interactions;

    public $post;
    public $comment = '';

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function bookmark(Post $post)
    {
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

    public function like(Post $post)
    {
        //        $this->skipRender();
        abort_if(
            ! auth()->check(),
            '404'
        );

        if (

            $post->likes->contains(
                'user_id',
                auth()->id()
            ))
        {

            return $post->likes()->where(
                'user_id',
                auth()->id()
            )->delete();

        }
        else
        {

            return $post->likes()->create(['user_id' => auth()->id()]);
        }
    }

    public function addComment()
    {
        $validated = $this->validate([
            'comment' => 'required|min:3',
        ]);

        $this->post->comments()->create(
            [
                'body'    => $validated['comment'],
                'user_id' => auth()->id(),
            ]
        );

        $this->comment = '';
        $this->banner()->close() // Enter in 3 seconds
        ->leave(seconds: 5) // Leave in 10 seconds
        ->success('Comment added successfully!')->send();
    }

    public function markAsSolved(Comment $comment)
    {

        if ( ! $comment->commentable)
        {
            return;
        }

        $comment->commentable()->update(['solution_comment_id' => $comment->id]);
        $this->banner()->close()->enter(seconds: 1)// Enter in 3 seconds
        ->leave(seconds: 5) // Leave in 10 seconds
        ->success('Comment was marked as solution!')->send();

        $this->dispatch('close');
        $this->dispatch('refreshComment');
        $this->render();

        //        return redirect()->back();
    }

    public function render()
    {
        $comments = $this->post->comments()->with(
            'comments',
            'commentable',
            'likes',
            'comments.user',
            'bookmarks',
            'user',
            'post'
        )->paginate(10);

        return view(
            'livewire.posts.show',
            [
                'comments' => $comments,
            ]
        );
    }

}
