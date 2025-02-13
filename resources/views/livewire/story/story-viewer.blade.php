<div x-data="{ isOpen: @entangle('isOpen'), video: null }"  {{-- Add video variable --}}
     x-show="isOpen"
     x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
     @click="isOpen = false; if (video) video.pause();">  {{-- Pause video on close --}}

    <div class="relative w-full max-w-md overflow-hidden bg-white rounded-lg shadow-lg md:max-w-lg lg:max-w-xl"
         @click.stop>
        <div class="relative h-screen md:h-[900px] bg-black">
            @if($stories && count($stories) > 0)
                @if($stories[$currentStoryIndex]->media_type === 'image')
                    <img src="{{ Storage::url($stories[$currentStoryIndex]->media_url) }}" alt="Story" class="object-cover w-full h-full">
                @else
                    <video x-ref="storyVideo"  {{-- Add x-ref to the video --}}
                           src="{{ Storage::url($stories[$currentStoryIndex]->media_url) }}"
                           class="object-cover w-full h-full"
                           autoplay loop
                           x-init="video = $refs.storyVideo">  {{-- Initialize video variable --}}
                    </video>
                @endif

                @if($stories[$currentStoryIndex]->text)
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white bg-black bg-opacity-50">
                        <p class="text-lg font-medium">{{ $stories[$currentStoryIndex]->text }}</p>
                    </div>
                @endif

                <div class="absolute inset-0 flex items-center justify-between">
                    <button wire:click="previousStory" class="p-3 text-white transition duration-300 bg-black bg-opacity-50 rounded-full hover:bg-opacity-75">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button wire:click="nextStory" class="p-3 text-white transition duration-300 bg-black bg-opacity-50 rounded-full hover:bg-opacity-75">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>

                <button wire:click="closeStoryViewer" class="absolute z-10 p-2 text-white transition duration-300 bg-black bg-opacity-50 rounded-full top-4 right-4 hover:bg-opacity-75">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            @endif  </div>
    </div>
</div>
