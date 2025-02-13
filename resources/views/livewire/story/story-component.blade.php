<div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-xl">
    <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Create Your Story</h2>
    <form wire:submit.prevent="createStory" enctype="multipart/form-data" class="space-y-6">
        <div class="flex flex-col gap-6 md:flex-row">
            <div class="w-full md:w-1/2">
                <div class="mb-4">
                    <label for="media" class="block mb-2 text-sm font-medium text-gray-700">Upload Media (Image/Video)</label>
                    <div class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="media" class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="media" wire:model="media" type="file" accept="image/*,video/*" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                    @error('media') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-700">Add Caption (optional)</label>
                    <textarea id="text" wire:model="text" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Write a caption for your story..."></textarea>
                    @error('text') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="w-full md:w-1/2">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Preview</label>
                    <div class="flex items-center justify-center h-64 p-2 mt-1 bg-gray-100 border-2 border-gray-300 border-dashed rounded-md">
                        @if ($media)
                            @if (str_starts_with($media->getMimeType(), 'image'))
                                <img src="{{ $media->temporaryUrl() }}" alt="Story preview" class="object-contain max-w-full max-h-full">
                            @elseif (str_starts_with($media->getMimeType(), 'video'))
                                <video src="{{ $media->temporaryUrl() }}" controls class="max-w-full max-h-full">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @else
                            <p class="text-gray-500">No media selected</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-3">
            <button type="button" wire:click="$emit('closeStoryCreator')" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 border border-transparent rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Cancel
            </button>
            <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create Story
            </button>
        </div>
    </form>
</div>

