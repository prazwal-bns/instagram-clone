<div class="max-w-xl mx-auto">
    {{-- header --}}
    <header class="flex items-center gap-3">
        {{-- <x-avatar story src="https://randomuser.me/api/portraits/men/{{ rand(0, 99) }}.jpg" class="w-10 h-10" /> --}}
        <x-avatar story src="{{ $post->user->photo }}" class="w-10 h-10" />

        <div class="grid w-full grid-cols-7 gap-2">

            <div class="col-span-5">
                <h5 class="text-sm font-semibold truncate"> {{ $post->user->name }} </h5>
            </div>

            <div class="flex justify-end col-span-2 text-right">

                <button class="ml-auto text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path
                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    </svg>
                </button>
            </div>


        </div>


    </header>

    {{-- main --}}
    <main>
        <div class="my-2">
            <!-- Slider main container -->
            <div x-init="new Swiper($el, {
                modules: [Navigation, Pagination],
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                },

                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });" class="swiper h-[500px] border bg-white">
                <ul x-cloak class="swiper-wrapper" >
                    <!-- Slides -->
                    @foreach ($post->media as $file)
                    <li class="swiper-slide">
                        @switch($file->mime)
                            @case('video')
                                <x-video source="{{ $file->url }}"/>
                                @break
                            @case('image')
                            <svg width="0" height="0">
                                <defs>
                                    <linearGradient id="heartGradient" x1="-1.77809" y1="-0.460531" x2="37.5412" y2="27.0711" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FF7A00"/>
                                        <stop offset="0.4" stop-color="#FF0169"/>
                                        <stop offset="1" stop-color="#D300C5"/>
                                    </linearGradient>
                                </defs>
                            </svg>

                            <div x-data="{ liked: false }" class="relative">
                                <img
                                    src="{{ $file->url }}"
                                    alt=""
                                    class="h-[500px] w-full block object-scale-down"
                                    x-on:dblclick="liked = true; $wire.likePost(); setTimeout(() => liked = false, 1000)"
                                >

                                <!-- Heart icon for feedback -->
                                <div x-show="liked" x-transition.opacity class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-32 h-32 opacity-75 heart-animation" width="48" height="42" viewBox="0 0 48 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M34.6 0.100098C30.1 0.100098 26.7 1.9001 24 5.7001C21.3 2.0001 17.9 0.200098 13.4 0.200098C6 0.100098 0 6.6001 0 14.6001C0 21.9001 5.4 26.6001 10.6 31.1001C11.2 31.6001 11.9 32.2001 12.5 32.8001L14.8 34.8001C19.2 38.7001 21.4 40.7001 22.4 41.3001C22.9 41.6001 23.5 41.8001 24 41.8001C24.5 41.8001 25.1 41.6001 25.6 41.3001C26.6 40.7001 28.4 39.1001 33.4 34.5001L35.4 32.7001C36.1 32.1001 36.7 31.5001 37.4 31.0001C42.7 26.6001 48 22.0001 48 14.6001C48 6.6001 42 0.100098 34.6 0.100098Z" fill="url(#heartGradient)"/>
                                    </svg>
                                </div>
                            </div>
                                @break
                            @default

                        @endswitch
                    </li>
                    @endforeach
                </ul>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                @if ($post->media->count() > 1)
                    <div class="swiper-button-prev">

                    </div>

                    <div class="swiper-button-next">

                    </div>
                @endif

                <!-- If we need scrollbar -->
                {{-- <div class="swiper-scrollbar"></div> --}}
            </div>

        </div>
    </main>

    {{-- footer --}}
    <footer>
        <div class="flex items-center gap-4 my-2">
            {{-- Heart --}}
            @if ($post->isLikedBy(auth()->user()))
                <button wire:click="togglePostLike()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-rose-500">
                        <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                      </svg>

                </button>
            @else
            <button wire:click="togglePostLike()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </button>
            @endif


            @if ($post->allow_commenting)
                <button onclick="Livewire.dispatch('openModal',{component: 'post.view.modal', arguments: {'post': {{ $post->id }}}})" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>
                </button>
            @endif




            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="w-5 h-5 bi bi-send" viewBox="0 0 16 16">
                    <path
                        d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                </svg>
            </span>

            {{-- Bookmark --}}
            <span class="ml-auto">
            @if ($post->hasBeenFavoritedBy(auth()->user()))
                <button wire:click="toggleFavourite()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-rose-500">
                        <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                      </svg>
                </button>
            @else
                <button wire:click="toggleFavourite()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg>
                </button>
            @endif

            </span>

        </div>

        @if ($post->totalLikers>0 && !$post->hide_like_view)
            <p class="text-sm font-bold">{{ $post->totalLikers }} {{ $post->totalLikers > 1 ? 'likes' : 'like' }}</p>
        @endif
        {{-- Likes or views --}}

        {{-- name & comment --}}
        <div class="flex gap-2 text-sm font-medium ">
            <p> <strong class="font-bold">{{ $post->user->name }}</strong> {{ $post->description }}</p>
        </div>


        @if ($post->allow_commenting)
        {{-- View Post Modal --}}
        <button onclick="Livewire.dispatch('openModal',{component: 'post.view.modal', arguments: {'post': {{ $post->id }}}})" class="text-sm font-medium text-slate-500/90">View all {{ $post->comments->count() }} comments </button>


        @auth
        {{-- Show auth comments  --}}
        <ul class="my-2">
            @foreach ($post->comments()->where('user_id',auth()->id())->latest()->take(2)->get() as $comment)
            <li class="grid items-center grid-cols-12 text-sm">

                <span class="col-span-2 mb-auto font-bold">{{auth()->user()->name}}</span>
                <span class="col-span-9">{{$comment->body}}</span>

                @if ($comment->isLikedBy(auth()->user()))
                    <button wire:click="toggleCommentLike({{$comment->id}})">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-rose-500">
                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                        </svg>

                    </button>
                @else
                <button wire:click="toggleCommentLike({{$comment->id}})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                        stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </button>
                @endif


            </li>
            @endforeach

        </ul>
        @endauth

        {{-- Leave comment --}}
        <form wire:key="{{ time() }}" class="grid items-center w-full grid-cols-12 " x-data="{ body:@entangle('body') }"
            @submit.prevent="$wire.addComment()">

            @csrf
            <input placeholder="Leave a comment" type="text"
                class="w-full col-span-10 px-0 text-sm border-0 rounded-lg outline-none placeholder:text-sm focus:outline-none hover:ring-0 focus:ring-0"
                x-model="body">

            <div class="flex justify-end col-span-1 ml-auto text-right ">
                <button type="submit" x-cloak class="flex justify-end text-sm font-semibold text-blue-500"
                    x-show="body.length > 0">Post</button>

            </div>

            <span class="col-span-1 ml-auto ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                </svg>

            </span>

        </form>

        @endif

    </footer>

</div>
