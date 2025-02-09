<div class="w-full p-3 mt-6">
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <h3 class="text-4xl font-bold">Notifications</h3>


    <main class="w-full my-7">

        <div class="space-y-5">
            {{-- NewFollower --}}
            <div class="grid w-full grid-cols-12 gap-2">

                <a href="#" class="col-span-2">
                    <x-avatar wire:ignore src="https://randomuser.me/api/portraits/men/{{ rand(0, 99) }}.jpg"
                        class="w-10 h-10" />
                </a>

                <div class="col-span-7 font-medium">
                    <a href="#"> <strong>{{fake()->name}}</strong> </a>

                     started following you
                    <span class="text-gray-400">2d</span>
                </div>

                <div class="col-span-3">
                     {{-- <button class="font-bold text-sm bg-blue-500 text-white px-3 py-1.5 rounded-lg">Follow</button> --}}
                     <button class="font-bold text-sm bg-gray-100 text-black/90 px-3 py-1.5 rounded-lg">Following</button>
                </div>

            </div>

            {{-- PostLiked --}}
            <div class="grid w-full grid-cols-12 gap-2 ">
                <a href="#" class="col-span-2">
                    <x-avatar  src="https://randomuser.me/api/portraits/men/{{ rand(0, 99) }}.jpg"
                        class="w-10 h-10" />
                </a>

                <div  class="col-span-7 font-medium">
                     <a href="#"> <strong>{{fake()->name}}</strong> </a>

                     <a href="#">
                        Liked your post 2d
                        <span class="text-gray-400">2d</span>
                     </a>

                </div>


                <a href="#" class="col-span-3 ml-auto">
                    <img src="https://randomuser.me/api/portraits/men/{{ rand(0, 99) }}.jpg" alt="image" class="object-cover w-10 h-11">
                </a>

            </div>


            {{-- NewComment--}}
            <div class="grid w-full grid-cols-12 gap-2 ">
                <a href="#" class="col-span-2">
                    <x-avatar wire:ignore src="https://randomuser.me/api/portraits/men/{{ rand(0, 99) }}.jpg"
                        class="w-10 h-10" />
                </a>

                <div  class="col-span-7 font-medium">
                    <a href="#"> <strong>{{fake()->name}}</strong> </a>

                     <a href="#">
                        commented:
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur iure ab, ut nulla et ducimus iste dolor quidem
                        <span class="text-gray-400">2d</span>
                     </a>
                </div>


                <a class="col-span-3 ml-auto">
                    <img src="https://randomuser.me/api/portraits/men/{{ rand(0, 99) }}.jpg" alt="image" class="object-cover w-10 h-11">
                </a>

            </div>
        </div>

    </main>

</div>
