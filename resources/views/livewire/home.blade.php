<div
x-data="{

  canLoadMore:@entangle('canLoadMore')

}"
@scroll.window.trottle="
  scrollTop= window.scrollY ||window.scrollTop;
  divHeight= window.innerHeight||document.documentElement.clientHeight;
  scrollHeight = document.documentElement.scrollHeight;


  isScrolled= scrollTop+ divHeight >= scrollHeight-1;

  {{-- Check if user can load more  --}}

  if(isScrolled && canLoadMore){

    @this.loadMore();
  }
"
class="w-full h-full">

    {{--Header----}}
    <header class="sticky top-0 bg-white md:hidden">
        <div class="grid items-center grid-cols-12 gap-2">

            <div class="col-span-3">

              <img src="{{asset('assets/logo.png')}}"  class="w-full h-12 max-w-lg" alt="logo">

            </div>

              <div class="flex justify-center col-span-8 px-2">

                <input type="text" placeholder="Search"
                 class="w-full bg-gray-100 border-0 rounded-lg outline-none focus:outline-none"
                >

              </div>

            <div class="flex justify-center col-span-1">

              <a href="#">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>

                </span>
              </a>

            </div>
        </div>
      </header>

    {{--Main------}}

    {{-- <main class="grid gap-8 lg:grid-cols-12 md:mt-10"> --}}
        <main class="grid items-start gap-8 lg:grid-cols-12 md:mt-10">

            <aside class="overflow-hidden lg:col-span-8" x-data="{ isExpanded: true }">
                {{-- Stories --}}
                <section>
                    <ul class="flex items-center w-full gap-3 px-16 overflow-x-auto scrollbar-hide">
                        {{-- Add Story Button --}}
                        <li class="flex flex-col justify-center w-20 gap-1 p-2">
                            <button wire:click="$dispatch('open-story-creator')" class="relative">
                                <x-avatar :src="auth()->user()->photo ? asset(auth()->user()->photo) : null" class="h-18 w-18" />
                                <span class="absolute bottom-0 right-0 flex items-center justify-center w-6 h-6 text-white bg-blue-500 rounded-full">+</span>
                            </button>
                            <p class="text-xs font-medium truncate">Your Story</p>
                        </li>

                        @foreach ($activeStories as $story)
                            <li class="flex flex-col justify-center w-20 gap-1 p-2">
                                <button wire:click="$dispatch('view-user-stories', { userId: {{ $story->user_id }} })">
                                    <x-avatar story :src="$story->user->photo" class="h-18 w-18" />
                                </button>
                                <p class="text-xs font-medium truncate">{{ $story->user->name }}</p>
                            </li>
                        @endforeach
                    </ul>
                </section>

                {{-- Posts --}}
                <section class="mt-10 space-y-8">
                    @if ($posts)
                        @foreach ($posts as $post)
                            <livewire:post.item wire:key="post-{{ $post->id }}" :post="$post"/>
                        @endforeach
                    @else
                        <p class="flex justify-center font-bold">No posts</p>
                    @endif
                </section>
            </aside>

            {{-- Suggestions --}}
            <aside class="hidden p-4 lg:col-span-4 lg:block">

                <a href="{{ route('profile.home', auth()->user()->username) }}">
                    <div class="flex items-center gap-2">

                        <x-avatar class="w-12 h-12"
                         :src="auth()->user()->photo ? asset(auth()->user()->photo) : null"
                          />

                        <h4 class="flex font-medium intems-center ">{{ auth()->user()->name }}
                            @if(auth()->user()->is_verified)
                                <span class="pl-2 text-blue-500">
                                    <svg aria-label="Verified" class="x1lliihq x1n2onr6" fill="rgb(0, 149, 246)" height="20" role="img" viewBox="0 0 40 40" width="20"><title>Verified</title><path d="M19.998 3.094 14.638 0l-2.972 5.15H5.432v6.354L0 14.64 3.094 20 0 25.359l5.432 3.137v5.905h5.975L14.638 40l5.36-3.094L25.358 40l3.232-5.6h6.162v-6.01L40 25.359 36.905 20 40 14.641l-5.248-3.03v-6.46h-6.419L25.358 0l-5.36 3.094Zm7.415 11.225 2.254 2.287-11.43 11.5-6.835-6.93 2.244-2.258 4.587 4.581 9.18-9.18Z" fill-rule="evenodd"></path></svg>
                                </span>
                            @endif
                        </h4>
                    </div>
                </a>
                <section class="mt-4">
                    <h4 class="font-bold text-gray-700/95">Suggestions For You</h4>
                    <ul class="my-2 space-y-3">
                        @foreach ($suggestedUsers as $user)
                            <li class="flex items-center gap-3">

                                <a href="{{ route('profile.home', $user->username) }}" class="font-semibold ">
                                    <x-avatar class="w-12 h-12"
                                        src="{{ $user->photo ? $user->photo : 'https://randomuser.me/api/portraits/men/' . rand(0, 99) . '.jpg' }}" />
                                </a>

                                <div class="grid w-full grid-cols-7 gap-2">
                                    <div class="col-span-5">
                                        <a href="{{ route('profile.home', $user->username) }}" class="flex items-center font-semibold truncate">
                                            {{ $user->name }}
                                            @if($user->is_verified)
                                                <span class="pl-2 text-blue-500">
                                                    <svg aria-label="Verified" class="x1lliihq x1n2onr6" fill="rgb(0, 149, 246)" height="18" role="img" viewBox="0 0 40 40" width="18">
                                                        <title>Verified</title>
                                                        <path d="M19.998 3.094 14.638 0l-2.972 5.15H5.432v6.354L0 14.64 3.094 20 0 25.359l5.432 3.137v5.905h5.975L14.638 40l5.36-3.094L25.358 40l3.232-5.6h6.162v-6.01L40 25.359 36.905 20 40 14.641l-5.248-3.03v-6.46h-6.419L25.358 0l-5.36 3.094Zm7.415 11.225 2.254 2.287-11.43 11.5-6.835-6.93 2.244-2.258 4.587 4.581 9.18-9.18Z" fill-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            @endif
                                        </a>

                                        <p class="text-xs truncate">Followed by {{$user->name}} </p>
                                    </div>
                                    <div class="flex justify-end col-span-2 text-right">

                                        @if (auth()->user()->isFollowing($user))
                                            <button wire:click="toggleFollow({{ $user->id }})" class="ml-auto text-sm font-bold text-gray-500">Following</button>
                                        @else
                                            <button wire:click="toggleFollow({{ $user->id }})" class="ml-auto text-sm font-bold text-blue-500">Follow</button>
                                        @endif

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>

                {{-- App links --}}
                <section class="mt-5">
                    <ol class="flex flex-wrap gap-2">
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">About</a></li>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">Help</a></li>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">Press</a></li>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">API</a></li>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">Jobs</a>
                        </li>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">Privacy </a>
                        </li>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">Terms</a></li>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">Locations</a>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">Language</a>
                        </li>
                        <li class="text-xs font-medium text-gray-800/90"><a href="#" class="hover:underline">Meta
                                Verified</a></li>
                    </ol>

                    <h3 class="mt-6 text-sm text-gray-800/90">© 2025 Instagram from Meta</h3>
                </section>

                {{-- Toggle Button --}}
                {{-- <button @click="isExpanded = !isExpanded" class="absolute text-gray-600 top-4 right-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button> --}}

            </aside>
        </main>



        {{-- Story Creator Modal --}}
        <div x-data="{ open: false }"
            x-on:open-story-creator.window="open = true"
            x-on:close-story-creator.window="open = false"
            x-show="open"
            x-cloak
            class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                 @click="open = false">
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="open"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button @click="open = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                            Create a Story
                        </h3>
                        <div class="mt-2">
                            @livewire('story.story-component')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
