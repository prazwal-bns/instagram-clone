<?php

namespace App\Livewire\Post\View;

use App\Models\Comment ;
use App\Models\Post;
use App\Notifications\NewCommentNotification;
use App\Notifications\PostLikedNotification;
use Livewire\Component;

class Item extends Component
{
    public Post $post;
    public $body;
    public $parent_id = null;

    public function render()
    {
        $comments =  $this->post->comments()->whereDoesntHave('parent')->get();
        return view('livewire.post.view.item',['comments' => $comments]);
    }

    public function addComment(){
        $this->validate([
            'body'=> 'required'
        ]);

        $comment = Comment::create([
            'body' => $this->body,
            'parent_id' => $this->parent_id,
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
            'user_id' => auth()->user()->id
        ]);

        $this->reset('body');

        // send notification if post is commented by someone
        if($this->post->user_id != auth()->user()->id){
            $this->post->user->notify(new NewCommentNotification(auth()->user(),$comment));
        }
    }

    public function setParent(Comment $comment){
        $this->parent_id = $comment->id;
        $this->body="@ ".$comment->user->name;
    }

    public function likePost(){
        abort_unless(auth()->check(),401);
        auth()->user()->like($this->post);

        // send notification if post is liked
        if($this->post->isLikedBy(auth()->user())){
            if($this->post->user_id != auth()->user()->id){
                $this->post->user->notify(new PostLikedNotification(auth()->user(),$this->post));
            }
        }
    }

    public function togglePostLike(){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleLike($this->post);
        // send notification if post is liked
        if($this->post->isLikedBy(auth()->user())){
            if($this->post->user_id != auth()->user()->id){
                $this->post->user->notify(new PostLikedNotification(auth()->user(),$this->post));
            }
        }
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
