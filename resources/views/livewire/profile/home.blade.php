<x-profile-layout :user="$user">
    <ul class="grid grid-cols-3 gap-3">

        @foreach ($posts as $post)
        {{-- Create variable to avoid DIY --}}
        @php
            $cover= $post->media()->first();
        @endphp

        <li
        onclick="Livewire.dispatch('openModal',{ component: 'post.view.modal', arguments:{'post':{{$post->id}}}})"
         class="w-full h-32 border rounded cursor-pointer md:h-72 cursor">
            {{-- Check mime --}}
            @switch($cover?->mime)

                @case('video')

                {{-- <x-video  source="{{$cover->url}}"  /> --}}
                <x-my-reels :controls="false" source="{{$cover->url}}"  />

                @break
                @case('image')

                <img src="{{$cover->url}}" alt="image" class="object-cover w-full h-full">

                @break

                @default

            @endswitch

        </li>
        @endforeach



    </ul>

</x-profile-layout>
