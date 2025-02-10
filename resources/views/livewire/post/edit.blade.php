<div class="bg-white lg:h-[500px] flex flex-col border gap-y-4 px-5">
    <header class="w-full py-2 border-b">
        <div class="flex justify-between">
            <button wire:click="$dispatch('closeModal')" class="font-bold">
                X
            </button>
            <div class="text-lg font-bold">
                Edit post
            </div>
            <button wire:click="update" class="font-bold text-blue-500">
                Update
            </button>
        </div>
    </header>

    <main class="grid w-full h-full grid-cols-12 gap-3 overflow-hidden">
        {{-- Media --}}
        <aside class="items-center w-full m-auto overflow-scroll lg:col-span-7">
            @if($post->media->isNotEmpty())
                <div class="flex overflow-x-scroll w-[500px] h-96 snap-x snap-mandatory gap-2 px-2">
                    @foreach($post->media as $media)
                        <div class="w-full h-full shrink-0 snap-always snap-center">
                            @if(str_contains($media->mime, 'image'))
                                <img class="object-contain w-full h-full" src="{{ $media->url }}" alt="Image">
                            @elseif(str_contains($media->mime, 'video'))
                                <x-video :source="$media->url" />
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p>No media available for this post.</p>
            @endif
        </aside>

        {{-- Details --}}
        <aside class="flex flex-col h-full gap-4 p-3 overflow-hidden overflow-y-scroll border-l lg:col-span-5">
            <div class="flex items-center gap-2">
                <x-avatar class="w-9 h-9" src="{{ auth()->user()->photo }}" />
                <h5 class="font-bold">{{ auth()->user()->name }}</h5>
            </div>

            <div>
                <textarea wire:model="description" placeholder="Add a caption."
                    class="w-full h-32 px-0 bg-white border-0 rounded-lg focus:border-0 focus:outline-none focus:ring-0"></textarea>
            </div>

            <div class="flex items-center grid-cols-12 gird">
                <input wire:model="location" placeholder="Add Location" type="text"
                    class="w-full px-0 bg-white border-0 rounded-lg focus:border-0 placeholder:font-normal focus:outline-none focus:ring-0">
            </div>

            <section class="" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full p-2 -ml-2 text-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:text-gray-300">
                    <div class="flex items-center gap-1">
                        <h6 class="text-base font-medium text-gray-500">Advanced settings</h6>
                    </div>
                    <div>
                        <span x-show="!open">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.6" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                        <span x-cloak x-show="open">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.6" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                        </span>
                    </div>
                </button>

                <ul x-cloak x-show="open" x-collapse class="w-full py-2 space-y-2">
                    <li>
                        <div class="flex items-center justify-between gap-3">
                            <span>Hide like and view counts on this post</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input wire:model="hide_like_view" type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center justify-between gap-3">
                            <span>Allow commenting</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input wire:model="allow_commenting" type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </li>
                </ul>
            </section>
        </aside>
    </main>
</div>

