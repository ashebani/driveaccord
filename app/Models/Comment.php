<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'commentable_id',
        'commentable_type',
        'user_id',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->morphTo(Post::class);
    }

    public function comments()
    {
        return $this->morphMany(
            Comment::class,
            'commentable',
        );
    }

    public function bookmarks()
    {
        return $this->morphMany(
            Bookmark::class,
            'bookmarkable',
        );
    }

    public function likes()
    {
        return $this->morphMany(
            Like::class,
            'likeable'
        );
    }
}
