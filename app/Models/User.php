<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function comments()
    {
        return $this->hasMany(
            Comment::class,
        );
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function route(): string
    {
        return '/users/'.$this->id;
    }

    public function likedPosts()
    {
        return $this->hasMany(Like::class);
    }

    public function savedPosts(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function getImageUrlAttribute()
    {
        return 'https://api.dicebear.com/7.x/bottts/svg?seed='.$this->name;
        //            asset(
        //            'storage/avatars/'.$this->image
        //        ) : 'https://api.dicebear.com/7.x/bottts/svg?seed='.$this->name;
        //            'images/adffff_1707302812.jpg';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email === 'a@a.com';
    }
}
