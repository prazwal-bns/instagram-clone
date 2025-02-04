<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public $user;
    public function toggleFollow()  {
        abort_unless(auth()->check(),401);
        auth()->user()->toggleFollow($this->user);
    }


    #[On('closeModal')]
    public function reverUrl()
    {
        $this->js("history.replaceState({},'','/')");
    }


    function mount($user)  {
        $this->user= User::whereUsername($user)->withCount(['followers','followings','posts'])->firstOrFail();
    }

    public function render()
    {

        #add this in order to update the withCount() variables on hydrate
        $this->user= User::whereUsername($this->user->username)->withCount(['followers','followings','posts'])->firstOrFail();

        $posts = $this->user->posts()->where('type','post')->get();
        return view('livewire.profile.home', ['posts'=>$posts]);
    }
}
