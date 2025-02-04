<?php

namespace App\Livewire\Post;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public $body;

    public function render()
    {
        return view('livewire.post.item');
    }

    public function addComment(){
        $this->validate([
            'body'=> 'required'
        ]);

        Comment::create([
            'body' => $this->body,
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
            'user_id' => auth()->user()->id
        ]);

        $this->reset('body');
    }

    public function likePost(){
        abort_unless(auth()->check(),401);
        auth()->user()->like($this->post);
    }

    public function togglePostLike(){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleLike($this->post);
    }

    public function toggleCommentLike(Comment $comment){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleLike($comment);
    }

    public function toggleFavourite(){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleFavorite($this->post);
    }
}
