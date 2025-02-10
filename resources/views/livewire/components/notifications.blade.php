<div
    x-init="

    Echo.private('users.{{auth()->user()->id}}')
        .notification((notification) => {
        // alert('reached');
        $wire.$refresh();
        // @this.$refresh();
        });
    "


    class="w-full p-3">

    <h3 class="text-4xl font-bold">Notifications</h3>


    <main class="w-full my-7">
        <div class="space-y-5">
            @foreach ($notifications as $notification)
                @switch($notification->type)
                @case('App\Notifications\NewFollowerNotification')

                @php
                    $user = App\Models\User::find($notification->data['user_id']);
                @endphp

                {{-- NewFollower --}}
                <div class="grid w-full grid-cols-12 gap-2">

                    <a href="{{ route('profile.home', $user->username) }}" class="col-span-2">
                        <x-avatar wire:ignore src="{{ asset($user->photo) }}"
                            class="w-10 h-10" />
                    </a>

                    <div class="col-span-7 font-medium">
                        <a href="{{ route('profile.home', $user->username) }}"> <strong>{{$user->name}}</strong> </a>

                        started following you
                        <span class="text-gray-400">{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</span>
                    </div>

                    <div class="col-span-3">
                        @if (auth()->user()->isFollowing($user))
                            <button wire:click="toggleFollow({{ $user->id}})" class="font-bold text-sm bg-gray-100 text-black/90 px-3 py-1.5 rounded-lg">Following</button>
                        @else
                            <button wire:click="toggleFollow({{ $user->id}})" class="font-bold text-sm bg-blue-500 text-white px-3 py-1.5 rounded-lg">Follow</button>
                        @endif

                    </div>

                </div>
                @break

                @case('App\Notifications\PostLikedNotification')
                @php
                    $user = App\Models\User::find($notification->data['user_id']);
                    $post = App\Models\Post::find($notification->data['post_id']);
                @endphp
                {{-- PostLiked --}}
                <div class="grid w-full grid-cols-12 gap-2 ">
                    <a href="{{ route('profile.home', $user->username) }}" class="col-span-2">
                        <x-avatar src="{{ asset($user->photo) }}" class="w-10 h-10" />
                    </a>

                    <div class="col-span-7 font-medium">
                        <a href="{{ route('profile.home', $user->username) }}"> <strong>{{$user->name}}</strong> </a>

                        <a href="{{ route('post', $post->id) }}">
                            Liked your post
                            <span class="text-gray-400">{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</span>
                        </a>

                    </div>


                    <a href="{{ route('post', $post->id) }}" class="col-span-3 ml-auto">
                        @php
                            $cover = $post->media->first();
                        @endphp
                            @switch($cover->mime)
                            @case('video')

                            <div class="w-10 h-11 ">
                                <video src="{{ $cover->url }}" alt="Video cover" class="object-cover w-10 h-11">
                            </div>

                            @break
                            @case('image')
                                <img src="{{$cover->url}}" alt="image" class="object-cover w-10 h-11">
                            @break
                            @default

                            @endswitch
                    </a>

                </div>

                @break

                @case('App\Notifications\NewCommentNotification')
                @php
                    $user = App\Models\User::find($notification->data['user_id']);
                    $comment = App\Models\Comment::find($notification->data['comment_id']);
                @endphp
                {{-- NewComment--}}
                <div class="grid w-full grid-cols-12 gap-2 ">
                    <a href="{{ route('profile.home', $user->username) }}" class="col-span-2">
                        <x-avatar wire:ignore src="{{ asset($user->photo) }}"
                            class="w-10 h-10" />
                    </a>

                    <div class="col-span-7 font-medium">
                        <a href="{{ route('profile.home', $user->username) }}"> <strong>{{$user->name}}</strong> </a>

                        <a href="{{ route('post', $comment->commentable->id) }}">
                            commented:
                            {{ Str::limit($comment->body, 10) }}
                            <span class="text-gray-400">{{ $notification->created_at->shortAbsoluteDiffForHumans() }}</span>
                        </a>
                    </div>


                    <a href="{{route('post',$comment->commentable->id)}}" class="col-span-3 ml-auto">
                        @php
                            $cover = $comment->commentable->media->first();
                        @endphp
                            @switch($cover->mime)
                            @case('video')

                            <div class="w-10 h-11 ">
                                <x-video :controls="false" source="{{$cover->url}}" />
                            </div>

                            @break
                            @case('image')
                                <img src="{{$cover->url}}" alt="image" class="object-cover w-10 h-11">
                            @break
                            @default

                            @endswitch
                    </a>

                </div>
                @break

                @default

                @endswitch
            @endforeach
        </div>

    </main>

</div>
