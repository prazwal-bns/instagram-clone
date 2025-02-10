<?php

namespace App\Livewire\Post;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public $post;
    public $postId;
    public $description;
    public $location;
    public $hide_like_view;
    public $allow_commenting;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->loadPost();
    }

    protected function loadPost()
    {
        $this->post = Post::find($this->postId);

        if (!$this->post) {
            $this->dispatch('close');
            session()->flash('error', 'The post you tried to edit no longer exists.');
            return;
        }

        if ($this->post->user_id !== auth()->id()) {
            $this->dispatch('close');
            session()->flash('error', 'You do not have permission to edit this post.');
            return;
        }

        $this->description = $this->post->description;
        $this->location = $this->post->location;
        $this->hide_like_view = $this->post->hide_like_view;
        $this->allow_commenting = $this->post->allow_commenting;
    }

    public function update()
    {
        if (!$this->post) {
            $this->loadPost();
            if (!$this->post) {
                $this->dispatch('close');
                session()->flash('error', 'Unable to update the post. It may have been deleted.');
                return;
            }
        }

        $this->validate([
            'description' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'hide_like_view' => 'boolean',
            'allow_commenting' => 'boolean',
        ]);

        $this->post->update([
            'description' => $this->description,
            'location' => $this->location,
            'hide_like_view' => $this->hide_like_view,
            'allow_commenting' => $this->allow_commenting,
        ]);


        $this->dispatch('close');
        $this->dispatch('post-updated',$this->post->id);



    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.post.edit');
    }
}

