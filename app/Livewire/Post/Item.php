<?php

namespace App\Livewire\Post;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewFollowerNotification;
use App\Notifications\PostLikedNotification;
use Livewire\Attributes\On;
use Livewire\Component;

class Item extends Component
{
    public Post $post;

    public $body;
    public bool $hide_like_view = false;
    public bool $allow_commenting = false;

    #[On('post-updated')]
    public function update(Post $post){
        $this->post = $post;
    }

    #[On('post-deleted')]
    public function delete(){
        $this->posts = Post::latest()->get();
    }

    public function render()
    {
        return view('livewire.post.item');
    }

    public function deletePost($postId){
        $post = Post::findOrFail($postId);

        if($post->user_id != auth()->user()->id){
            abort(403, 'You\'re not authorized to delete this post.');
        }

        $post->comments()->delete();

        $post->media()->delete();
        $post->delete();

        $this->reset();

        $this->dispatch('post-deleted');
    }

    public function toggleHideLikeView($postId)
    {
        $post = Post::findOrFail($postId);

        $post->hide_like_view = !$post->hide_like_view;

        $post->save();

        $this->dispatch('post-updated', $post->id);
        $this->dispatch('close');
    }

    public function toggleFollow(User $user){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleFollow($user);

        if($user->isFollowing(auth()->user())){
            $user->notify(new NewFollowerNotification(auth()->user()));
        }


    }

    public function toggleCommenting($postId){
        $post = Post::findOrFail($postId);

        $post->allow_commenting = !$post->allow_commenting;

        $post->save();

        $this->dispatch('post-updated', $post->id);
        $this->dispatch('close');
    }


    public function addComment(){
        $this->validate([
            'body'=> 'required'
        ]);

        $comment = Comment::create([
            'body' => $this->body,
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
