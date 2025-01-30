<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{

    use WithPagination;

    public $posts;

    public $canLoadMore;

    public $perPageIncrement = 5;

    public $perPage = 10;

    #[On('closeModal')]
    public function reverUrl()
    {
        $this->js("history.replaceState({},'','/')");
    }


    #[On('post-created')]
    public function postCreaed($id)
    {

        $post = Post::find($id);

        $this->posts = $this->posts->prepend($post);
    }


    /*
     * --------------------------
     * Load more posts
     *---------------------------*/

     public function loadMore()
     {
        if (!$this->canLoadMore) {
            return null;
        }
        #increment page
        $this->perPage += $this->perPageIncrement;

        #load posts 
        $this->loadPosts();
     }

     #function to laod posts
    public function loadPosts()
    {
        $this->posts = Post::with('comments.replies')->latest()
            ->take($this->perPage)->get();
        $this->canLoadMore = (count($this->posts) >= $this->perPage);
    }


    public function mount()
    {
        $this->loadPosts();
    }

    public function render()
    {
        return view('livewire.home');
    }
}