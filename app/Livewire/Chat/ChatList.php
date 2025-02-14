<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class ChatList extends Component
{
    // protected $listeners = ['refresh' => '$refresh'];
    public function refresh()
    {
        // This method will be called when the 'refresh' event is dispatched
        // You can add any additional logic here if needed
    }
    public function render()
    {
        $conversations = auth()->user()->conversations()->latest('updated_at')->get();
        return view('livewire.chat.chat-list',['conversations'=>$conversations]);
    }
}
