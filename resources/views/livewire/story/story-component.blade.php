<div class="min-h-screen px-4 py-12 bg-gray-50 sm:px-6 lg:px-8">
    <div class="mx-auto overflow-hidden bg-white shadow-2xl max-w-7xl rounded-xl">
        <div class="p-8">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-900">Create Your Story</h1>

            <form wire:submit.prevent="createStory" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <!-- Left Column - Upload Section -->
                    <div class="space-y-6">
                        <div class="relative">
                            <label class="block mb-3 text-lg font-medium text-gray-700">
                                Upload Media
                            </label>

                            <div
                                class="relative transition-all duration-200 ease-in-out border-2 border-gray-300 border-dashed h-96 rounded-xl bg-gray-50 hover:border-indigo-500 hover:bg-indigo-50"
                                x-data="{ isHovering: false }"
                                x-on:dragover.prevent="isHovering = true"
                                x-on:dragleave.prevent="isHovering = false"
                                x-on:drop.prevent="isHovering = false"
                                x-bind:class="{ 'border-indigo-500 bg-indigo-50': isHovering }"
                            >
                                <label for="media" class="absolute inset-0 flex flex-col items-center justify-center cursor-pointer">
                                    <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <div class="text-center">
                                        <span class="font-medium text-indigo-600">Upload media</span>
                                        <span class="text-gray-500"> or drag and drop</span>
                                        <p class="mt-2 text-sm text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                    <input
                                        id="media"
                                        wire:model="media"
                                        type="file"
                                        accept="image/*,video/*"
                                        class="sr-only"
                                    >
                                </label>
                            </div>
                            @error('media')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="text" class="block mb-3 text-lg font-medium text-gray-700">
                                Caption
                            </label>
                            <textarea
                                id="text"
                                wire:model="text"
                                rows="4"
                                class="w-full px-4 py-3 border border-gray-300 shadow-sm resize-none rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Write something captivating..."
                            ></textarea>
                            @error('text')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column - Preview Section -->
                    <div>
                        <label class="block mb-3 text-lg font-medium text-gray-700">
                            Preview
                        </label>
                        <div class="p-4 bg-gray-900 rounded-xl">
                            <div class="flex items-center justify-center bg-black rounded-lg h-[700px]">
                                @if ($media)
                                    @if (str_starts_with($media->getMimeType(), 'image'))
                                        <img src="{{ $media->temporaryUrl() }}" alt="Preview" class="object-contain max-w-full max-h-full">
                                    @elseif (str_starts_with($media->getMimeType(), 'video'))
                                        <video src="{{ $media->temporaryUrl() }}" controls class="max-w-full max-h-full" >
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                @else
                                    <div class="text-center text-gray-500">
                                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="mt-2">No media selected</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end mt-8 space-x-4">
                    {{-- <button
                        type="button"
                        wire:click="$dispatch('closeStoryCreator')"
                        class="px-6 py-3 font-medium text-gray-700 transition-colors duration-200 bg-gray-100 rounded-lg hover:bg-gray-200"
                    >
                        Cancel
                    </button> --}}
                    <button type="button" wire:click="cancelStory" class="px-6 py-3 font-medium text-gray-700 transition-colors duration-200 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-3 font-medium text-white transition-colors duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700"
                    >
                        Create Story
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
