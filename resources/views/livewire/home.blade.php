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

            <aside class="overflow-hidden lg:col-span-8">

                {{-- Stories --}}
                <section>
                    <ul wire:ignore class="flex items-center w-full gap-3 px-16 overflow-x-auto scrollbar-hide">
                        @for ($i = 0; $i < 15; $i++)
                            <li class="flex flex-col justify-center w-20 gap-1 p-2">
                                <x-avatar story src="https://randomuser.me/api/portraits/men/{{ rand(0, 99) }}.jpg" class="h-18 w-18" />
                                <p class="text-xs font-medium truncate">{{ fake()->name }}</p>
                            </li>
                        @endfor
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
                <div class="flex items-center gap-2">
                    <x-avatar class="w-12 h-12" src="{{ auth()->user()->photo ? auth()->user()->photo : 'https://randomuser.me/api/portraits/men/' . rand(0, 99) . '.jpg' }}" />
                    <h4 class="font-medium">{{ auth()->user()->name }}</h4>
                </div>
                <section class="mt-4">
                    <h4 class="font-bold text-gray-700/95">Suggestions For You</h4>
                    <ul class="my-2 space-y-3">
                        @foreach ($suggestedUsers as $user)
                            <li class="flex items-center gap-3">
                                <x-avatar src="{{ $user->photo }}" class="w-12 h-12" />
                                <div class="grid w-full grid-cols-7 gap-2">
                                    <div class="col-span-5">
                                        <h5 class="text-sm font-semibold truncate">{{$user->name}} </h5>
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

            </aside>
        </main>

</div>
