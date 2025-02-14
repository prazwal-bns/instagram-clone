<?php

namespace App\Livewire\Story;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class StoryComponent extends Component
{
    use WithFileUploads;

    public $media;
    public $mediaType;
    public $text;
    public $availableMediaTypes = ['image', 'video'];
    public $isOpen = true;

    #[On('navigate-home')]
    public function cancelStory()
    {
        $this->reset(['media', 'mediaType', 'text']);
        if ($this->media) {
            $this->media->delete();
        }
        $this->closeStoryCreator();
        $this->redirect('/', navigate: true);
    }

    protected $rules = [
        'media' => 'required|file|max:20480',
        'text' => 'nullable|string|max:255',
    ];

    public function updatedMedia()
    {
        $this->validateOnly('media');

        if ($this->media) {
            $mimeType = $this->media->getMimeType();
            if (str_starts_with($mimeType, 'image')) {
                $this->mediaType = 'image';
            } elseif (str_starts_with($mimeType, 'video')) {
                $this->mediaType = 'video';
            } else {
                $this->addError('media', 'Unsupported file type. Please upload an image or video.');
                $this->media = null;
                $this->mediaType = null;
            }
        } else {
            $this->mediaType = null;
        }
    }

    public function createStory()
    {
        $this->validate();

        $mediaPath = $this->media->store('stories', 'public');

        Story::create([
            'user_id' => auth()->id(),
            'media_type' => $this->mediaType,
            'media_url' => $mediaPath,
            'text' => $this->text,
            'expires_at' => Carbon::now()->addHours(24),
            // 'expires_at' => Carbon::now()->addSeconds(30),
        ]);

        $this->reset(['media', 'mediaType', 'text']);
        $this->dispatch('story-created');

        return redirect()->route('home');
    }

    // public function cancelStory()
    // {
    //     $this->reset(['media', 'mediaType', 'text']);
    //     if ($this->media) {
    //         $this->media->delete();
    //     }
    //     $this->closeStoryCreator();
    // }

    public function closeStoryCreator()
    {
        $this->isOpen = false;
        $this->dispatch('story-creator-closed');
    }

    public function render()
    {
        return view('livewire.story.story-component');
    }
}

