@props(['user'])
<div class="max-w-3xl mx-auto">

    {{-- Mobile only header --}}
    <header class="grid items-center grid-cols-12 px-2 py-2 border-b lg:hidden">
        {{-- cheveron from heroicons --}}
        <button onclick="history.back()" class="col-span-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>

        </button>

        {{--profile username --}}
        <div class="col-span-8 ">
            <span class="flex items-center col-span-11 gap-1 text-lg font-medium lg:col-span-5">
                {{$user->username}}

                @if($user->is_verified)
                    <span class="pl-2 text-blue-500">
                        <svg aria-label="Verified" class="x1lliihq x1n2onr6" fill="rgb(0, 149, 246)" height="20" role="img" viewBox="0 0 40 40" width="20"><title>Verified</title><path d="M19.998 3.094 14.638 0l-2.972 5.15H5.432v6.354L0 14.64 3.094 20 0 25.359l5.432 3.137v5.905h5.975L14.638 40l5.36-3.094L25.358 40l3.232-5.6h6.162v-6.01L40 25.359 36.905 20 40 14.641l-5.248-3.03v-6.46h-6.419L25.358 0l-5.36 3.094Zm7.415 11.225 2.254 2.287-11.43 11.5-6.835-6.93 2.244-2.258 4.587 4.581 9.18-9.18Z" fill-rule="evenodd"></path></svg>
                    </span>
                @endif
            </span>
        </div>

        <span class="flex justify-end col-span-2 ">

            {{-- Guest options bututon --}}
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path
                        d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                </svg>
            </button>


        </span>

    </header>


    {{-- Details --}}
    <section class="grid grid-cols-12 p-2 my-5 lg:my-12 ">

        {{-- Avatar --}}
        <div class="flex items-center col-span-4">
            <x-avatar class="w-20 h-20 m-auto lg:h-44 lg:w-44" :src="$user->photo ? asset($user->photo) : null" />

        </div>


        <aside class="flex flex-col col-span-8 gap-5 lg:max-w-2xl lg:mx-auto">

            {{-- Actions --}}
            <section class="grid grid-cols-12 gap-3">
                <span class="flex items-center col-span-11 gap-1 text-lg font-medium truncate lg:col-span-5">
                    {{$user->username}}

                    @if($user->is_verified)
                        <span class="pl-2 text-blue-500">
                            <svg aria-label="Verified" class="x1lliihq x1n2onr6" fill="rgb(0, 149, 246)" height="20" role="img" viewBox="0 0 40 40" width="20"><title>Verified</title><path d="M19.998 3.094 14.638 0l-2.972 5.15H5.432v6.354L0 14.64 3.094 20 0 25.359l5.432 3.137v5.905h5.975L14.638 40l5.36-3.094L25.358 40l3.232-5.6h6.162v-6.01L40 25.359 36.905 20 40 14.641l-5.248-3.03v-6.46h-6.419L25.358 0l-5.36 3.094Zm7.415 11.225 2.254 2.287-11.43 11.5-6.835-6.93 2.244-2.258 4.587 4.581 9.18-9.18Z" fill-rule="evenodd"></path></svg>
                        </span>
                    @endif
                </span>

                {{-- Wrap around auth--}}
                @auth
                {{-- Check if user owns profile or not --}}

                @if (auth()->id()==$user->id)

                <div class="grid grid-cols-2 col-span-12 gap-3 lg:col-span-6 ">

                    {{-- Send message button --}}
                    <a href="{{ route('edit.my-profile') }}" type="button"
                        class=" inline-flex justify-center font-bold items-center  rounded-lg  text-sm p-1.5 px-2 transition  bg-gray-200 hover:bg-slate-100 ">
                        Edit profile
                    </a>

                </div>

                <button class="hidden col-span-1 lg:flex">
                    {{-- horizontal dots from bootstrap icons--}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                </button>
                @else

                <div class="grid grid-cols-2 col-span-12 gap-3 lg:col-span-6 ">

                    {{-- check following status --}}
                    @if (auth()->user()->isFollowing($user))
                    <button wire:click="toggleFollow()" type="button"
                        class=" inline-flex justify-center font-bold items-center  rounded-lg  text-sm p-1.5 px-2 transition  bg-gray-200 hover:bg-slate-100 ">
                        Following
                    </button>
                    @else


                    <button wire:click="toggleFollow()" type="button"
                        class=" inline-flex justify-center font-bold items-center  rounded-lg  text-sm p-1.5 px-2 transition  bg-blue-500 text-white  ">
                        Follow
                    </button>
                    @endif

                    {{-- Send message button --}}
                    <button wire:click="message({{ $user->id }})" type="button"
                        class=" inline-flex justify-center font-bold items-center  rounded-lg  text-sm p-1.5 px-2 transition  bg-gray-200 hover:bg-slate-100 ">
                        Message
                    </button>

                </div>

                <button class="hidden col-span-1 lg:flex">
                    {{-- horizontal dots from bootstrap icons--}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path
                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
                </button>

                @endif

                @endauth
            </section>

            {{-- following details --}}
            <div class="grid w-full grid-cols-3 gap-2">
                <span class="font-bold" wire:key='{{time()}}'>{{$user->posts_count}} Posts</span>
                <span class="font-bold">{{$user->followers_count}} Followers</span>
                <span class="font-bold">{{$user->followings_count}} following</span>
            </div>

            {{-- profile user's name --}}
            <h4 class="text-2xl font-bold">
                {{$user->name}}
            </h4>
            <p>
                <a href="{{$user->website_link}}" target="_blank" class="font-semibold text-blue-500 hover:underline hover:font-bold">
                    {{$user->website}}
                </a>
            </p>


            <h3>
                {{$user->bio}}
            </h3>






        </aside>

    </section>


    {{-- Tabs --}}
    <section class="border-t">
        <ul class="flex justify-between max-w-sm mx-auto text-center">
            {{-- Posts --}}
            <li class="relative flex flex-col items-center justify-center flex-1 py-2 cursor-pointer">
                <a wire:navigate class="flex flex-col items-center justify-center gap-1 py-2"
                    href="{{ route('profile.home', $user->username) }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-border-all lg:w-5 lg:h-5" viewBox="0 0 16 16">
                            <path
                                d="M0 0h16v16H0V0zm1 1v6.5h6.5V1H1zm7.5 0v6.5H15V1H8.5zM15 8.5H8.5V15H15V8.5zM7.5 15V8.5H1V15h6.5z" />
                        </svg>
                    </span>
                    <h4 class="font-bold capitalize">Posts</h4>
                </a>
                @if (request()->routeIs('profile.home'))
                    <div class="absolute bottom-0 w-full border-t-2 border-black"></div>
                @endif
            </li>

            {{-- Reels --}}
            <li class="relative flex flex-col items-center justify-center flex-1 py-2 cursor-pointer">
                <a wire:navigate class="flex flex-col items-center justify-center gap-1 py-2"
                    href="{{ route('profile.reels', $user->username) }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" id="instagram-reel">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M1 6.5A5.5 5.5 0 0 1 6.5 1h11A5.5 5.5 0 0 1 23 6.5v11a5.5 5.5 0 0 1-5.5 5.5h-11A5.5 5.5 0 0 1 1 17.5v-11ZM6.5 3A3.5 3.5 0 0 0 3 6.5v11A3.5 3.5 0 0 0 6.5 21h11a3.5 3.5 0 0 0 3.5-3.5v-11A3.5 3.5 0 0 0 17.5 3h-11Z"
                                clip-rule="evenodd"></path>
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M9.038 10.113a1 1 0 0 1 1.035.068l5 3.5a1 1 0 0 1 0 1.638l-5 3.5A1 1 0 0 1 8.5 18v-7a1 1 0 0 1 .538-.887zm1.462 2.808v3.158l2.256-1.579-2.256-1.58zM1 8a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H2a1 1 0 0 1-1-1z"
                                clip-rule="evenodd"></path>
                            <path fill="#000" fill-rule="evenodd"
                                d="M7.684 1.051a1 1 0 0 1 1.265.633l2 6a1 1 0 0 1-1.897.632l-2-6a1 1 0 0 1 .632-1.265zm6 0a1 1 0 0 1 1.265.633l2 6a1 1 0 0 1-1.897.632l-2-6a1 1 0 0 1 .632-1.265z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <h4 class="font-bold capitalize">Reels</h4>
                </a>
                @if (request()->routeIs('profile.reels'))
                    <div class="absolute bottom-0 w-full border-t-2 border-black"></div>
                @endif
            </li>

            @auth
                @if (auth()->user()->id == $user->id)
                    {{-- Saved --}}
                    <li class="relative flex flex-col items-center justify-center flex-1 py-2 cursor-pointer">
                        <a wire:navigate class="flex flex-col items-center justify-center gap-1 py-2"
                            href="{{ route('profile.saved', $user->username) }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-bookmark lg:w-5 lg:h-5" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                </svg>
                            </span>
                            <h4 class="font-bold capitalize">Saved</h4>
                        </a>
                        @if (request()->routeIs('profile.saved'))
                            <div class="absolute bottom-0 w-full border-t-2 border-black"></div>
                        @endif
                    </li>
                @endif
            @endauth
        </ul>
    </section>



    <main class="my-7">
        {{$slot}}
    </main>

</div>
