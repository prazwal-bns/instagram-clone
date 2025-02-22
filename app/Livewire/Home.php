<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Story;
use App\Models\User;
use App\Notifications\NewFollowerNotification;
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

    protected $listeners = ['story-deleted' => 'removeDeletedStory'];

    public function removeDeletedStory($storyId)
    {
        $this->activeStories = $this->activeStories->filter(function ($story) use ($storyId) {
            return $story->id !== $storyId;
        });
    }

    #[On('closeModal')]
    public function reverUrl()
    {
        $this->js("history.replaceState({},'','/')");
    }


    #[On('post-created')]
    public function postCreated($id)
    {
        $post = Post::find($id);
        $this->posts = $this->posts->prepend($post);
    }

    public function getActiveStoriesProperty()
    {
        return Story::with('user')
            ->where('expires_at', '>', now())
            ->orderBy('created_at')
            // ->orderBy('created_at', 'desc')
            ->get()
            ->unique('user_id');
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

    public function toggleFollow(User $user){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleFollow($user);

        if($user->isFollowing(auth()->user())){
            $user->notify(new NewFollowerNotification(auth()->user()));
        }
    }

    public function render()
    {
        $suggestedUsers = User::where('id', '!=', auth()->id())->limit(5)->get();
        return view('livewire.home',[
            'suggestedUsers' => $suggestedUsers,
            'activeStories' => $this->activeStories,
        ]);
    }
}
