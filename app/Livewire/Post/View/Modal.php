<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;

class Modal extends ModalComponent
{
    public $post;

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     *
     */
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }



    function mount() {

        $this->post=Post::findOrFail($this->post);

        #get url to push in the history state  ---we will create this route later
        $url=url('post/'.$this->post->id);

        #push state using new livewire js() helper , you can check docks for that
        $this->js("history.pushState({}, '', '{$url}')");


    }



    public function render()
    {
        return <<<'BLADE'
        <main class="bg-white h-[calc(100vh_-_3.5rem)] md:h-[calc(100vh_-_5rem)] p-2  flex flex-col border gap-y-4  px-5">
        {{-- header --}}
        <livewire:post.view.item :post="$this->post" />


        </main>
        BLADE;
    }
}
