<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class Reels extends Component
{

    #[On('closeModal')]
    public function reverUrl()
    {
        $this->js("history.replaceState({},'','/explore')");
    }

    public function togglePostLike(Post $post){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleLike($post);
    }

    public function toggleFavorite(Post $post){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleFavorite($post);
    }

    public function render()
    {
        $posts = Post::where('type','reel')->latest()->limit(20)->get();
        return view('livewire.reels',['posts'=>$posts]);
    }
}
