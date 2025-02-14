<div class="grid w-full h-full gap-3 overflow-hidden lg:grid-cols-12">
    @if ($post)
    <aside class="items-center hidden w-full m-auto overflow-scroll lg:flex lg:col-span-7">


        {{-- Css snap scroll --}}
        <div
            class="relative flex overflow-x-scroll overscroll-contain w-[500px] selection:snap-x snap-mandatory gap-2 px-2">


            @foreach ($post->media as $key => $file)

            <div class="w-full h-full shrink-0 snap-always snap-center" x-data="{ liked: false }">

                @switch($file->mime)
                @case('video')
                <x-video source="{{$file->url}}" />
                @break
                @case('image')
                <svg width="0" height="0">
                    <defs>
                        <linearGradient id="heartGradient" x1="-1.77809" y1="-0.460531" x2="37.5412" y2="27.0711"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FF7A00" />
                            <stop offset="0.4" stop-color="#FF0169" />
                            <stop offset="1" stop-color="#D300C5" />
                        </linearGradient>
                    </defs>
                </svg>

                <div class="relative">
                    <img src="{{$file->url}}" alt="image" class="block object-scale-down w-full h-full"
                        x-on:dblclick="liked = true; $wire.likePost(); setTimeout(() => liked = false, 1000)">

                    <!-- Heart icon for feedback -->
                    <div x-show="liked" x-transition.opacity class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-32 h-32 opacity-75 heart-animation" width="48" height="42" viewBox="0 0 48 42"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M34.6 0.100098C30.1 0.100098 26.7 1.9001 24 5.7001C21.3 2.0001 17.9 0.200098 13.4 0.200098C6 0.100098 0 6.6001 0 14.6001C0 21.9001 5.4 26.6001 10.6 31.1001C11.2 31.6001 11.9 32.2001 12.5 32.8001L14.8 34.8001C19.2 38.7001 21.4 40.7001 22.4 41.3001C22.9 41.6001 23.5 41.8001 24 41.8001C24.5 41.8001 25.1 41.6001 25.6 41.3001C26.6 40.7001 28.4 39.1001 33.4 34.5001L35.4 32.7001C36.1 32.1001 36.7 31.5001 37.4 31.0001C42.7 26.6001 48 22.0001 48 14.6001C48 6.6001 42 0.100098 34.6 0.100098Z"
                                fill="url(#heartGradient)" />
                        </svg>
                    </div>
                </div>

                @break
                @default
                @endswitch

            </div>

            @endforeach




        </div>

    </aside>

    <aside class="relative flex flex-col h-full gap-4 overflow-hidden overflow-y-scroll lg:col-span-5 scrollbar-hide">

        <header class="sticky top-0 z-10 flex items-center gap-3 py-2 bg-white border-b ">

            <a href="{{ route('profile.home', $post->user->username) }}">
                <x-avatar src="{{ asset($post->user->photo) }}" class="w-9 h-9" />
            </a>

            <div class="grid w-full grid-cols-7 gap-2">

                <div class="col-span-5">
                    <a href="{{ route('profile.home', $post->user->username) }}" class="flex items-center text-sm font-semibold truncate">
                        {{ $post->user->name }}
                        @if($post->user->is_verified)
                            <span class="pl-2 text-blue-500">
                                <svg aria-label="Verified" class="x1lliihq x1n2onr6" fill="rgb(0, 149, 246)" height="18" role="img" viewBox="0 0 40 40" width="18">
                                    <title>Verified</title>
                                    <path d="M19.998 3.094 14.638 0l-2.972 5.15H5.432v6.354L0 14.64 3.094 20 0 25.359l5.432 3.137v5.905h5.975L14.638 40l5.36-3.094L25.358 40l3.232-5.6h6.162v-6.01L40 25.359 36.905 20 40 14.641l-5.248-3.03v-6.46h-6.419L25.358 0l-5.36 3.094Zm7.415 11.225 2.254 2.287-11.43 11.5-6.835-6.93 2.244-2.258 4.587 4.581 9.18-9.18Z" fill-rule="evenodd"></path>
                                </svg>
                            </span>
                        @endif
                    </a>
                </div>

                <div class="flex justify-end col-span-2 text-right">

                    {{-- <button wire:click="$dispatch('closeModal')" class="ml-auto text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>


                    </button> --}}

                    <div x-data="{ open: false }" class="relative flex justify-end col-span-2 text-right">
                        <button @click.stop="open = !open" class="ml-auto text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                        </button>

                        <!-- Modal -->
                        <div x-show="open" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                            @click="open = false">
                            <div class="w-11/12 max-w-md bg-white rounded-lg shadow-lg">
                                <!-- Modal Content -->
                                <div class="py-4">
                                    <div x-data="{ showConfirmDelete: false }"
                                        class="flex flex-col divide-y divide-gray-200">
                                        @if ($post->user_id == auth()->user()->id)
                                        <button @click.stop="showConfirmDelete = true"
                                            class="w-full px-4 py-3 text-center text-red-600 hover:bg-gray-100">
                                            Delete
                                        </button>

                                        <button
                                            wire:click.stop="$dispatch('openModal', { component: 'post.edit', arguments: { postId: {{ $post->id }} } }); open = false"
                                            class="w-full px-4 py-3 text-center text-gray-700 hover:bg-gray-100">
                                            Edit
                                        </button>

                                        <button class="w-full px-4 py-3 text-center text-gray-700 hover:bg-gray-100"
                                            @click.stop="$wire.toggleHideLikeView({{ $post->id }}); open = false">
                                            {{ $post->hide_like_view == 0 ? 'Hide like to Others' : 'Show like counts to
                                            others' }}
                                        </button>

                                        <button class="w-full px-4 py-3 text-center text-gray-700 hover:bg-gray-100"
                                            @click.stop="$wire.toggleCommenting({{ $post->id }}); open = false">
                                            {{ $post->allow_commenting == 0 ? 'Turn on commenting' : 'Turn off
                                            commenting' }}
                                        </button>
                                        @endif

                                        <a href="{{ route('post', $post->id) }}"
                                            class="w-full px-4 py-3 text-center text-gray-700 hover:bg-gray-100"
                                            @click="open = false">
                                            Go to post
                                        </a>

                                        @if ($post->user_id != auth()->user()->id)
                                        <button class="w-full px-4 py-3 text-center text-gray-700 hover:bg-gray-100"
                                                @click="$wire.toggleFavourite();open = false">
                                            {{ auth()->user()->hasFavorited($post) ? 'Remove from favorites' : 'Add to favorites' }}
                                        </button>

                                        <a href="{{ route('profile.home', $post->user->username) }}"
                                            class="w-full px-4 py-3 text-center text-gray-700 hover:bg-gray-100"
                                            @click="open = false">
                                            View Profile
                                        </a>

                                        <button class="w-full px-4 py-3 text-center text-red-700 hover:bg-gray-100"
                                            @click="$wire.toggleFollow({{ $post->user_id }}) ;open = false">
                                            {{ auth()->user()->isFollowing($post->user) ? 'Unfollow' : 'Follow' }}
                                        </button>
                                        @endif

                                        <!-- Confirmation Dialog -->
                                        <div x-show="showConfirmDelete"
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                                            @click.self="showConfirmDelete = false">
                                            <div class="p-6 bg-white rounded-lg shadow-xl">
                                                <h3 class="mb-4 text-lg font-semibold">Are you sure you want to delete
                                                    this post?</h3>
                                                <div class="flex justify-end space-x-4">
                                                    <button @click="showConfirmDelete = false"
                                                        class="px-4 py-2 text-gray-600 rounded hover:bg-gray-100">
                                                        Cancel
                                                    </button>
                                                    <button wire:click="deletePost({{ $post->id }})"
                                                        @click="showConfirmDelete = false; open = false"
                                                        class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                                                        Confirm Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cancel Button -->
                                <div class="border-t border-gray-200">
                                    <button class="w-full px-4 py-3 text-center text-gray-700 hover:bg-gray-100"
                                        @click="open = false">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

        </header>

        <main>

            @if ($comments)
            {{-- Comment item --}}
            @foreach ($comments as $comment)
            <section class="flex flex-col gap-2">

                {{-- comment --}}
                @include('livewire.post.view.partials.comment')


                {{-- reply --}}
                @if ($comment->replies->count() > 0)

                @foreach ($comment->replies as $reply)
                {{-- reply --}}
                @include('livewire.post.view.partials.reply')
                @endforeach

                @endif


            </section>
            @endforeach

            @else
            No Comments
            @endif


        </main>

        {{-- footer --}}
        <footer class="sticky bottom-0 mt-auto bg-white border-t">

            {{-- actions --}}
            <div class="flex items-center gap-4 my-2">

                @if ($post->isLikedBy(auth()->user()))
                <button wire:click="togglePostLike()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 text-rose-500">
                        <path
                            d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
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
                {{-- comment --}}
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>

                </span>
                @endif
                {{-- forward --}}
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="w-5 h-5 bi bi-send" viewBox="0 0 16 16">
                        <path
                            d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                    </svg>
                </span>

                {{-- Bookmark --}}
                @if ($post->hasBeenFavoritedBy(auth()->user()))
                <button wire:click="toggleFavourite()" class="ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 text-rose-500">
                        <path fill-rule="evenodd"
                            d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                @else
                <button wire:click="toggleFavourite()" class="ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg>
                </button>
                @endif

            </div>

            {{-- likes and views --}}
            @if ($post->totalLikers>0 && !$post->hide_like_view)
            <p class="text-sm font-bold">{{ $post->totalLikers }} {{ $post->totalLikers > 1 ? 'likes' : 'like' }}</p>
            @endif

            {{-- name and comment --}}
            <div class="flex gap-2 text-sm font-medium">
                <p> <strong class="font-bold">{{$post->user->name}} </strong>
                    {{$post->description}}
                </p>
            </div>

            @if ($post->allow_commenting)

            {{-- view post modal --}}
            <button class="text-sm font-medium text-slate-500/90"> Total {{ $post->comments->count() }} comments
            </button>



            {{-- leave comment --}}
            <div class="relative" x-data="{
                showEmojiPicker: false,
                 insertEmoji(emoji) {
                    const currentBody = this.$wire.body || '';
                    this.$wire.set('body', currentBody + emoji);
                }
            }" x-init="$watch('$wire.body', value => $refs.commentInput.value = value || '')">
                <form wire:key="{{ time() }}" class="grid items-center w-full grid-cols-12" wire:submit.prevent="addComment">
                    @csrf
                    <input placeholder="Leave a comment" type="text"
                        class="w-full col-span-10 px-0 text-sm border-0 rounded-lg outline-none placeholder:text-sm focus:outline-none hover:ring-0 focus:ring-0"
                        wire:model.defer="body"
                        x-ref="commentInput">

                    <div class="col-span-1">
                        <div class="flex justify-end ml-auto text-right">
                            <button type="submit" x-cloak class="flex justify-end text-sm font-semibold text-blue-500"
                                x-show="$wire.body && $wire.body.length > 0">Post</button>
                        </div>
                    </div>

                    {{-- Emoji --}}
                    <span class="col-span-1 ml-auto cursor-pointer" @click="showEmojiPicker = !showEmojiPicker">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                        </svg>
                    </span>
                </form>

                {{-- Emoji Picker --}}
                <div x-show="showEmojiPicker" x-cloak
                    class="absolute right-0 z-10 p-2 mb-2 bg-white border rounded-lg shadow-lg bottom-full"
                    @click.outside="showEmojiPicker = false">
                    <emoji-picker class="light" @emoji-click="insertEmoji($event.detail.unicode)"></emoji-picker>
                </div>

            </div>


            @endif
        </footer>

    </aside>

    @endif
</div>
