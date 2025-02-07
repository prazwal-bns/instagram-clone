<?php

namespace App\Livewire;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Editprofile extends Component
{
    use WithFileUploads;

    public $photo;
    public $user;
    public $name;
    public $address;
    public $bio;
    public $gender;
    public $website;
    public $website_link;

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->address = $this->user->address;
        $this->bio = $this->user->bio;
        $this->gender = $this->user->gender;
        $this->website = $this->user->website;
        $this->website_link = $this->user->website_link;
    }


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:8048',
        ]);
    }


    public function savePhoto()
    {
        $this->validate([
            'photo' => 'image|max:8048',
        ]);

        $filename = 'user_' . $this->user->id . '_' . time() . '.' . $this->photo->getClientOriginalExtension();

        // Store the file directly in the public/images directory
        $path = public_path('images/' . $filename);
        File::put($path, file_get_contents($this->photo->getRealPath()));

        // if ($this->user->photo && file_exists(public_path($this->user->photo))) {
        //     unlink(public_path($this->user->photo));
        // }

        $this->user->update(['photo' => 'images/' . $filename]);

        $this->user = $this->user->fresh();

        $this->photo = null;
        session()->flash('message', 'Photo updated successfully!');

        return redirect()->route('edit.my-profile');
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:150',
            'website' => 'nullable|string|max:150',
            'website_link' => 'nullable|string|max:150',
            'gender' => 'nullable|in:male,female,other',
        ]);

        auth()->user()->update([
            'name' => $this->name,
            'address' => $this->address,
            'bio' => $this->bio,
            'gender' => $this->gender,
            'website' => $this->website,
            'website_link' => $this->website_link
        ]);

        session()->flash('message', 'Profile updated successfully!');

        return redirect()->route('profile.home', auth()->user()->username);
    }


    public function render()
    {
        return view('livewire.editprofile');
    }
}
