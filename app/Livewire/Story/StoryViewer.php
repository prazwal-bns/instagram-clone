<?php

namespace App\Livewire\Story;

use Livewire\Component;
use App\Models\Story;

class StoryViewer extends Component
{
    public $stories;
    public $currentStoryIndex = 0;
    public $userId;
    public $isOpen = false;

    protected $listeners = ['view-user-stories' => 'viewUserStories'];

    public function viewUserStories($userId)
    {
        $this->userId = $userId;
        $this->stories = Story::where('user_id', $userId)
            ->where('expires_at', '>', now())
            ->orderBy('created_at', 'asc')
            ->get();
        $this->currentStoryIndex = 0;
        $this->isOpen = true;
    }

    public function closeStoryViewer()
    {
        $this->isOpen = false;
        $this->reset(['stories', 'currentStoryIndex', 'userId']);
    }

    public function nextStory()
    {
        if ($this->currentStoryIndex < count($this->stories) - 1) {
            $this->currentStoryIndex++;
        } else {
            $this->closeStoryViewer();
        }
    }

    public function previousStory()
    {
        if ($this->currentStoryIndex > 0) {
            $this->currentStoryIndex--;
        }
    }

    public function render()
    {
        return view('livewire.story.story-viewer');
    }
}
