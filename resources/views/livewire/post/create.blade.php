<div class="bg-white lg:h-[500px] flex flex-col border gap-y-4 px-5">


    <header class="w-full py-2 border-b">
        <div class="flex justify-between">

            <button wire:click="$dispatch('closeModal')" class="font-bold">
                X
            </button>

            <div class="text-lg font-bold">
                Create new post
            </div>


            <button @disabled(count($media)==0) wire:loading.attr="disabled"  wire:click="submit" class="font-bold text-blue-500 disabled:cursor-not-allowed disabled:opacity-25">
                Share
            </button>


        </div>


    </header>


    <main class="grid w-full h-full grid-cols-12 gap-3 overflow-hidden">

        {{-- Media --}}
        <aside class="items-center w-full m-auto overflow-scroll lg:col-span-7">

            @if (count($media) == 0)
                <label for="customFileInput" class="flex flex-col gap-3 m-auto cursor-pointer max-w-fit">
                    <input wire:model.live="media" type="file" wire:model="photo" multiple
                        accept=".jpg,.png,.jpeg,.mp4" class="sr-only" id="customFileInput">

                    <span class="m-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-14 h-14">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                    </span>

                    <span class="p-2 px-4 text-sm text-white bg-blue-500 rounded-lg">Upload files from
                        computer </span>
                </label>
            @else
                {{-- Show when file count >0 --}}
                <div class="  flex overflow-x-scroll w-[500px] h-96 snap-x snap-mandatory gap-2 px-2 ">


                    {{-- <div class="w-full h-full shrink-0 snap-always snap-center">
                    <x-video />

                </div>
                <div class="w-full h-full snap-always shrink-0 snap-center">
                    <img class="object-contain w-full h-full"
                        src="https://plus.unsplash.com/premium_photo-1666900440561-94dcb6865554?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cmFuZG9tfGVufDB8fDB8fHww&auto=format&fit=crop&w=800&q=60" />

                </div> --}}

                    @foreach ($media as $key => $file)
                        <div class="w-full h-full shrink-0 snap-always snap-center">
                            {{ dd($file->temporaryUrl()) }}
                            @if (strpos($file->getMimeType(), 'image') !== false)
                                <img class="object-contain w-full h-full" src="{{ $file->temporaryUrl() }}" alt="Image">
                            @elseif (strpos($file->getMimeType(), 'video') !== false)
                                <x-video :source="$file->temporaryUrl()" />
                            @endif



                        </div>
                    @endforeach

                </div>

            @endif



        </aside>


        {{-- Details --}}
        <aside class="flex flex-col h-full gap-4 p-3 overflow-hidden overflow-y-scroll border-l lg:col-span-5">

            <div class="flex items-center gap-2">
                <x-avatar class="w-9 h-9" src="{{ asset(auth()->user()->photo) }}" />
                <h5 class="font-bold">{{ auth()->user()->name }}</h5>
            </div>

            <div>

                <textarea wire:model="description" placeholder="Add a caption."
                    class="w-full h-32 px-0 bg-white border-0 rounded-lg focus:border-0 focus:outline-none focus:ring-0"></textarea>

                <p class="mt-3 text-xs text-gray-400 dark:text-gray-600">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit.</p>
            </div>

            <div class="flex items-center grid-cols-12 gird">
                <input wire:model="location" placeholder="Add Location" type="text"
                    class="w-full px-0 bg-white border-0 rounded-lg focus:border-0 placeholder:font-normal focus:outline-none focus:ring-0">
            </div>



            <section class="" x-data="{ open: false }">
                <button @click="open =! open" @class([
                    'flex cursor-pointer w-full  rounded-lg hover:bg-gray-50  p-2  -ml-2  justify-between items-center text-gray-700 dark:text-gray-300',
                ]) class="">


                    {{-- Selected --}}
                    <div class="flex items-center gap-1">
                        <h6 class="text-base font-medium text-gray-500 ">Advanced settings</h6>

                    </div>

                    {{-- Icon --}}
                    <div>
                        <span x-show="!open">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.6" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>

                        <span x-cloak x-show="open">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.6" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                        </span>
                    </div>


                </button>

                {{-- content --}}
                <ul x-cloak x-show="open" x-collapse class="w-full py-2 space-y-2 ">


                    <li>

                        <div class="flex items-center justify-between gap-3">

                            <span>
                                Hide like and view counts on this post
                            </span>
                            {{-- from flowbite big toggle --}}
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input wire:model="hide_like_view" type="checkbox" value="" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                            </label>

                        </div>

                        <p class="text-sm">
                            Only you will see the total number of likes and views on this post. You can change this
                            later by going to the ··· menu at the top of the post. To hide like counts on other people's
                            posts, go to your account settings.
                        </p>

                    </li>


                    <li>

                        <div class="flex items-center justify-between gap-3">

                            <span>
                                Allow commenting
                            </span>
                            {{-- from flowbite big toggle --}}
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input wire:model="allow_commenting" type="checkbox" value=""
                                    class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                            </label>

                        </div>


                    </li>



                </ul>


            </section>


        </aside>

    </main>
</div>
