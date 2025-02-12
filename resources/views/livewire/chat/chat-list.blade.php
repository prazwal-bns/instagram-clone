<div class="flex flex-col h-full overflow-hidden transition-all">

    <header class="sticky top-0 z-10 w-full px-3 py-2 bg-white sm:pt-12">

        {{-- Title/name and Icon --}}
        <section class="flex items-center justify-between pb-2 ">

            <div class="flex items-center gap-2 truncate">
                <h5 class="font-[900] text-2xl">{{auth()->user()->name}}</h5>
            </div>

            <button>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>



            </button>

        </section>

        {{-- Filters --}}
        <section class="grid items-center grid-cols-3 gap-3 p-2 mt-1 overflow-x-scroll bg-white ">

            <button class="flex justify-center pb-2 font-semibold text-black border-b-2 border-black">
                Primary
            </button>
            <button class="flex justify-center pb-2 font-semibold text-gray-500">
                General
            </button>
            <button class="flex justify-center pb-2 font-semibold text-gray-500">
                Requests
            </button>

        </section>

    </header>


    <main class="relative h-full overflow-hidden overflow-y-scroll grow" style="contain:content">
        @if($conversations!=null)
        {{-- chatlist --}}
        <ul class="grid w-full p-2 spacey-y-2">

            {{-- Chat list item --}}
            @foreach ($conversations as $conversation)
            @php
                $receiver = $conversation->getReceiver();
                $lastMessage = $conversation->messages()->latest()->first();
            @endphp
            <li
                class="relative flex w-full gap-4 px-2 py-3 transition-colors duration-150 cursor-pointer hover:bg-gray-50 rounded-2xl dark:hover:bg-gray-200/70 {{ request()?->chat==$conversation?->id?'bg-gray-100' : '' }}">

                <a href="{{ route('profile.home', $receiver->username) }}" class="shrink-0">
                    <x-avatar wire:ignore src="{{ asset($receiver->photo) }}"
                        class="w-12 h-12" />
                </a>

                <aside class="grid w-full grid-cols-12">


                    <a wire:navigate href="{{ route('chat.main',$conversation->id) }}"
                        class="relative w-full col-span-10 p-1 pb-2 overflow-hidden leading-5 truncate border-b border-gray-200 flex-nowrap">


                        {{-- name--}}
                        <div class="flex items-center justify-between w-full mb-1">
                            <h6 class="font-normal text-gray-900 truncate">
                                {{ $receiver->name }}
                            </h6>

                        </div>

                        {{-- Message body --}}
                        @if ($lastMessage!=null)
                        <div class="flex items-center gap-x-2">

                            {{-- Only show if AUTH is onwer of message --}}
                            @if ($lastMessage->sender_id==auth()->id())
                                <span class="text-xs font-bold">
                                    You:
                                </span>
                            @endif

                            <p class="  truncate text-xs font-[100]">
                                {{ $lastMessage?->body }}
                            </p>

                            <span class="px-1 text-xs font-medium text-gray-800 shrink-0 ">{{ $lastMessage->created_at->shortAbsoluteDiffForHumans()  }}</span>


                        </div>

                        @endif


                    </a>

                    {{-- Read status --}}
                    {{-- Only show if AUTH is NOT onwer of message --}}
                    <div class="{{ $lastMessage!=null && $lastMessage->sender_id!=auth()->id() && !$lastMessage->is_read ? 'visible' : 'invisible' }}flex flex-col col-span-2 my-auto text-center">

                        {{-- Dots icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="w-10 h-10 text-blue-500 bi bi-dot" viewBox="0 0 16 16">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                        </svg>

                    </div>


                </aside>

            </li>

            @endforeach

        </ul>

        @else
            no conversations

        @endif
    </main>
</div>
