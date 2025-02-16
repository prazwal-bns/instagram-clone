<div x-data="{
    isOpen: @entangle('isOpen'),
    video: null,
    isVideo: @entangle('isVideo'),
    isPaused: false,
    showDeleteConfirmation: false,
    storyToDelete: null,
    togglePlayPause() {
        if (this.video) {
            if (this.isPaused) {
                this.video.play();
                this.isPaused = false;
            } else {
                this.video.pause();
                this.isPaused = true;
            }
        }
    },
    confirmDelete(storyId) {
        this.storyToDelete = storyId;
        this.showDeleteConfirmation = true;
    },
    deleteStory() {
        $wire.deleteStory(this.storyToDelete);
        this.showDeleteConfirmation = false;
        this.storyToDelete = null;
    }
}"
    x-init="$watch('isOpen', value => {
        if (!value && video) {
            video.pause();
        }
    })"
    x-show="isOpen"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
    @click.self="isOpen = false">

    <div class="relative w-full max-w-md overflow-hidden bg-white rounded-lg shadow-lg md:max-w-lg lg:max-w-xl"
         @click.stop>
        <div class="relative h-screen md:h-[900px] bg-black">
            @if($users->isNotEmpty() && $stories && $stories->isNotEmpty())
                <div class="absolute top-0 left-0 right-0 z-10 flex items-center p-4 bg-gradient-to-b from-black to-transparent">
                    <img src="{{ $users[$currentUserIndex]->photo }}" alt="{{ $users[$currentUserIndex]->name }}" class="w-10 h-10 mr-3 rounded-full">
                    <div class="text-white">
                        <p class="font-bold">{{ $users[$currentUserIndex]->name }}</p>
                        <p class="text-xs">{{ $stories[$currentStoryIndex]->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="absolute top-0 left-0 right-0 z-10 flex h-1 mt-16 space-x-1 overflow-hidden">
                    @foreach($stories as $index => $story)
                        <div class="flex-1 h-full {{ $index <= $currentStoryIndex ? 'bg-white' : 'bg-gray-300' }}"></div>
                    @endforeach
                </div>

                @if(isset($stories[$currentStoryIndex]))
                    @if($stories[$currentStoryIndex]->media_type === 'image')
                        <img src="{{ Storage::url($stories[$currentStoryIndex]->media_url) }}" alt="Story" class="object-cover w-full h-full">
                    @else
                        <video x-ref="storyVideo"
                               src="{{ Storage::url($stories[$currentStoryIndex]->media_url) }}"
                               class="object-cover w-full h-full"
                               @play="isVideo = true; isPaused = false"
                               @pause="isPaused = true"
                               @ended="$wire.nextStory()"
                               x-init="video = $refs.storyVideo; video.play()">
                        </video>
                    @endif

                    @if($stories[$currentStoryIndex]->text)
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white bg-black bg-opacity-50">
                            <p class="text-lg font-medium">{{ $stories[$currentStoryIndex]->text }}</p>
                        </div>
                    @endif

                    <div class="absolute inset-0 flex items-center justify-between">
                        @if($this->hasPreviousStory())
                            <button @click.stop="$wire.previousStory()" class="p-3 text-white transition duration-300 bg-black bg-opacity-50 rounded-full hover:bg-opacity-75">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($this->hasNextStory())
                            <button @click.stop="$wire.nextStory()" class="p-3 text-white transition duration-300 bg-black bg-opacity-50 rounded-full hover:bg-opacity-75">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        @else
                            <div></div>
                        @endif
                    </div>

                    <button @click.stop="togglePlayPause()" x-show="isVideo" class="absolute z-10 p-2 text-white transition duration-300 bg-black bg-opacity-50 rounded-full bottom-4 left-4 hover:bg-opacity-75">
                        <svg x-show="!isPaused" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <svg x-show="isPaused" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>

                    @if($stories[$currentStoryIndex]->user_id === auth()->id())
                        <button @click.stop="confirmDelete({{ $stories[$currentStoryIndex]->id }})" class="absolute z-10 p-2 text-white transition duration-300 bg-red-500 rounded-full bottom-4 right-4 hover:bg-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    @endif
                @endif
            @else
                <div class="flex items-center justify-center h-full">
                    <p class="text-xl text-white">No stories available</p>
                </div>
            @endif
        </div>
    </div>

    <button wire:click="closeStoryViewer" class="absolute z-10 p-2 text-white transition duration-300 bg-black bg-opacity-50 rounded-full top-4 right-4 hover:bg-opacity-75">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteConfirmation" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click.stop>
        <div class="p-6 bg-white rounded-lg shadow-xl" @click.stop>
            <h2 class="mb-4 text-xl font-bold">Confirm Deletion</h2>
            <p class="mb-4">Are you sure you want to delete this story?</p>
            <div class="flex justify-end space-x-2">
                <button @click="showDeleteConfirmation = false" class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                <button @click="deleteStory()" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">Delete</button>
            </div>
        </div>
    </div>
</div>
