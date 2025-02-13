<?php

namespace App\Livewire\Story;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StoryComponent extends Component
{
    use WithFileUploads;

    public $media;
    public $mediaType;
    public $text;
    public $availableMediaTypes = ['image', 'video'];

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
        ]);

        $this->reset(['media', 'mediaType', 'text']);
        $this->dispatch('story-created');

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.story.story-component');
    }
}
