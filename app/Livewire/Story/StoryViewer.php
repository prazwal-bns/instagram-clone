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
    public $isVideo = false;

    protected $listeners = ['view-user-stories' => 'viewUserStories', 'storyEnded' => 'nextStory'];

    public function mount()
    {
        $this->users = User::has('stories')->get();
        $this->stories = new Collection();
    }

    public function viewUserStories($userId)
    {
        $userIndex = $this->users->search(function($user) use ($userId) {
            return $user->id == $userId;
        });

        if ($userIndex !== false) {
            $this->currentUserIndex = $userIndex;
            $this->loadUserStories();
            if ($this->stories->isNotEmpty()) {
                $this->isOpen = true;
                $this->setCurrentStoryType();
            }
        }
    }

    public function loadUserStories()
    {
        if ($this->currentUserIndex !== false && $this->currentUserIndex < $this->users->count()) {
            $currentUser = $this->users[$this->currentUserIndex];

            $this->stories = Story::where('user_id', $currentUser->id)
                ->where('expires_at', '>', now())
                ->orderBy('created_at', 'asc')
                ->get();

            if ($this->stories->isEmpty()) {
                $this->nextUser();
                return;
            }

            $this->currentStoryIndex = 0;
            $this->setCurrentStoryType();
        } else {
            $this->closeStoryViewer();
        }
    }

    public function setCurrentStoryType()
    {
        if ($this->stories->isNotEmpty() && isset($this->stories[$this->currentStoryIndex])) {
            $currentStory = $this->stories[$this->currentStoryIndex];
            $this->isVideo = $currentStory->media_type === 'video';
        }
    }

    public function closeStoryViewer()
    {
        $this->isOpen = false;
        $this->reset(['stories', 'currentStoryIndex', 'currentUserIndex']);
    }

    public function previousStory()
    {
        if ($this->currentStoryIndex > 0) {
            $this->currentStoryIndex--;
            $this->setCurrentStoryType();
        } else if ($this->currentUserIndex > 0) {
            $this->currentUserIndex--;
            $this->loadUserStories();
            if ($this->stories->isNotEmpty()) {
                $this->currentStoryIndex = $this->stories->count() - 1;
                $this->setCurrentStoryType();
            }
        }
    }

    public function nextStory()
    {
        if ($this->stories->isEmpty()) {
            $this->nextUser();
            return;
        }

        if ($this->currentStoryIndex < $this->stories->count() - 1) {
            $this->currentStoryIndex++;
            $this->setCurrentStoryType();
        } else {
            $this->nextUser();
        }
    }

    public function nextUser()
    {
        $this->currentUserIndex++;
        if ($this->currentUserIndex < $this->users->count()) {
            $this->loadUserStories();
        } else {
            $this->closeStoryViewer();
        }
    }

    public function previousUser()
    {
        if ($this->currentUserIndex > 0) {
            $this->currentUserIndex--;
            $this->loadUserStories();
        }
    }

    public function deleteStory($storyId)
    {
        $story = Story::find($storyId);
        if ($story && $story->user_id === auth()->id()) {
            $story->delete();

            // Remove the story from the collection
            $this->stories = $this->stories->filter(function ($s) use ($storyId) {
                return $s->id !== $storyId;
            })->values(); // Reset array keys

            if ($this->stories->isEmpty()) {
                // If no more stories for this user, move to the next user
                $this->removeCurrentUserIfNoStories();
                $this->nextUser();
            } else {
                // Adjust currentStoryIndex if necessary
                if ($this->currentStoryIndex >= $this->stories->count()) {
                    $this->currentStoryIndex = $this->stories->count() - 1;
                }
                $this->setCurrentStoryType();
            }

            // Emit an event to notify the parent component
            $this->dispatch('story-deleted', $storyId);
        }
    }

    public function removeCurrentUserIfNoStories()
    {
        if ($this->stories->isEmpty()) {
            $this->users = $this->users->filter(function ($user, $index) {
                return $index !== $this->currentUserIndex;
            })->values(); // Reset array keys

            if ($this->currentUserIndex >= $this->users->count()) {
                $this->currentUserIndex = max(0, $this->users->count() - 1);
            }
        }
    }

    public function hasPreviousStory()
    {
        return $this->currentStoryIndex > 0 || $this->currentUserIndex > 0;
    }

    public function hasNextStory()
    {
        return ($this->stories && $this->currentStoryIndex < $this->stories->count() - 1) || $this->currentUserIndex < $this->users->count() - 1;
    }

    public function render()
    {
        return view('livewire.story.story-viewer');
    }
}
