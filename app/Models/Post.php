<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Overtrue\LaravelLike\Traits\Likeable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, Likeable, Favoriteable;

    protected $guarded = [];

    protected $casts = [
        'hide_like_view' => 'boolean',
        'allow_commenting' => 'boolean',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function media(): MorphMany{
        return $this->morphMany(Media::class, 'mediable');
    }

    public function comments() : MorphMany {

        return  $this->morphMany(Comment::class,'commentable')->with('replies');
    }


}
