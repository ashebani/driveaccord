<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(
            Post::class,
            'likeable',

        );
    }

    public function comments(): MorphToMany
    {
        return $this->morphedByMany(
            Comment::class,
            'likeable'
        );
    }

}
