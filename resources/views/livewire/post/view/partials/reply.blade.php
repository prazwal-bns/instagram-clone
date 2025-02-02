<div class="flex items-center w-11/12 gap-3 py-2 ml-auto ">

    <x-avatar wire:ignore src="{{ 'https://randomuser.me/api/portraits/men/' . rand(0, 99) . '.jpg' }}" class="w-8 h-8 mb-auto" />

    <div class="grid w-full grid-cols-7 gap-2">
        {{-- comment --}}
        <div class="flex flex-wrap col-span-6 text-sm ">
            <p>

                <span class="text-sm font-bold">{{$reply->user->name}} </span>
                {{ $reply->body }}
            </p>

        </div>

        {{-- Like --}}
        <div class="flex justify-end col-span-1 mb-auto text-right">
            <button class="ml-auto text-sm font-bold 0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-3 h-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>

            </button>
        </div>

        {{-- Footer --}}
        <div class="flex col-span-7 gap-2 text-xs text-gray-700">

            <span class="">{{ $reply->created_at->diffForHumans() }}</span>
            <span class="font-bold"> 345 Likes</span>
            <button wire:click="setParent({{ $reply->id }})" class="font-semibold"> Reply</button>

        </div>
    </div>

</div>

@if ($reply->replies->count() > 0)

    @foreach ($reply->replies as $reply)

        @include('livewire.post.view.partials.reply')
    @endforeach

@endif
