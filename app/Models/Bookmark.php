<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function bookmarkable(): MorphTo
    {
        return $this->morphTo();
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(
            Post::class,
            'bookmarkable',

        );
    }

    public function comments(): MorphToMany
    {
        return $this->morphedByMany(
            Comment::class,
            'bookmarkable'
        );
    }
}
