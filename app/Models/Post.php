<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'user_id',
        'solution_comment_id',
    ];

    public function comments()
    {
        return $this->morphMany(
            Comment::class,
            'commentable'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function getTotalLikesAttribute()
    {
        return $this->likes->count();
        //            + $this->comments->flatMap->likes->count();
    }
}
