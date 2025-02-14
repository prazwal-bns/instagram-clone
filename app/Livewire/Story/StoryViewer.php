<?php

namespace App\Livewire\Story;

use Livewire\Component;
use App\Models\Story;
use App\Models\User;
use Illuminate\Support\Collection;

class StoryViewer extends Component
{
    public $stories;
    public $currentStoryIndex = 0;
    public $currentUserIndex = 0;
    public $users;
    public $isOpen = false;
    public $timer = 30;

    protected $listeners = ['view-user-stories' => 'viewUserStories'];

    public function mount()
    {
        $this->users = User::has('stories')->get();
        $this->stories = new Collection();
    }

    public function viewUserStories($userId)
    {
        $this->currentUserIndex = $this->users->search(function($user) use ($userId) {
            return $user->id == $userId;
        });
        $this->loadUserStories();
        $this->isOpen = true;
    }

    public function loadUserStories()
    {
        if ($this->currentUserIndex !== false && $this->currentUserIndex < $this->users->count()) {
            $this->stories = Story::where('user_id', $this->users[$this->currentUserIndex]->id)
                ->where('expires_at', '>', now())
                ->orderBy('created_at', 'asc')
                ->get();

            if ($this->stories->isEmpty()) {
                $this->nextUser();
                return;
            }

            $this->currentStoryIndex = 0;
            $this->resetTimer();
        } else {
            $this->closeStoryViewer();
        }
    }

    public function closeStoryViewer()
    {
        $this->isOpen = false;
        $this->reset(['stories', 'currentStoryIndex', 'currentUserIndex']);
    }

    public function nextStory()
    {
        if ($this->stories && $this->stories->isNotEmpty() && $this->currentStoryIndex < $this->stories->count() - 1) {
            $this->currentStoryIndex++;
            $this->resetTimer();
        } else {
            $this->nextUser();
        }
    }

    public function previousStory()
    {
        if ($this->currentStoryIndex > 0) {
            $this->currentStoryIndex--;
            $this->resetTimer();
        } else {
            $this->previousUser();
        }
    }

    public function nextUser()
    {
        $this->currentUserIndex++;
        if ($this->currentUserIndex < $this->users->count()) {
            $this->loadUserStories();
            $this->resetTimer();
        } else {
            $this->closeStoryViewer();
        }
    }

    public function previousUser()
    {
        if ($this->currentUserIndex > 0) {
            $this->currentUserIndex--;
            $this->loadUserStories();
            $this->resetTimer();
        }
    }

    public function deleteStory($storyId)
    {
        $story = Story::find($storyId);
        if ($story && $story->user_id === auth()->id()) {
            $story->delete();
            $this->stories = $this->stories->filter(function ($s) use ($storyId) {
                return $s->id !== $storyId;
            });
            if ($this->stories->isEmpty()) {
                $this->nextUser();
            } elseif ($this->currentStoryIndex >= $this->stories->count()) {
                $this->currentStoryIndex = $this->stories->count() - 1;
            }
            $this->resetTimer();

            // Emit an event to notify the parent component
            $this->dispatch('story-deleted', $storyId);
        }
    }

    public function resetTimer()
    {
        $this->timer = 30;
    }

    public function render()
    {
        return view('livewire.story.story-viewer');
    }
}
