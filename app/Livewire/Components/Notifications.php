<?php

namespace App\Livewire\Components;

use App\Models\User;
use App\Notifications\NewFollowerNotification;
use Livewire\Component;

class Notifications extends Component
{

    public function toggleFollow(User $user){
        abort_unless(auth()->check(),401);
        auth()->user()->toggleFollow($user);

        if($user->isFollowing(auth()->user())){
            $user->notify(new NewFollowerNotification(auth()->user()));
        }
    }

    public function render()
    {
        return view('livewire.components.notifications', ['notifications' => auth()->user()->notifications]);
    }
}
