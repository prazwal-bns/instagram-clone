<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use Livewire\Component;

class Page extends Component
{
    public $post;
    public function mount()  {

        $this->post=Post::findOrFail($this->post);

    }
    public function render()
    {
        return <<<'HTML'
          <main class="flex flex-col min-h-screen px-5 mx-auto bg-white border max-w-7xl gap-y-4">

                <div class="my-auto border p-2  h-[calc(100vh_-_3.5rem)]">
                <livewire:post.view.item :post="$this->post" />


                </div>

            </main>
        HTML;
    }
}
