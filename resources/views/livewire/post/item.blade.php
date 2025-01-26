<div class="max-w-xl mx-auto">
    {{-- In work, do what you enjoy. --}}


    {{-- header --}}

    <header class="flex items-center gap-3">
        <x-avatar story src="https://randomuser.me/api/portraits/men/{{ rand(0, 99) }}.jpg" class="h-10 w-10" />

        <div class="grid grid-cols-7 w-full gap-2">

            <div class="col-span-5">
                <h5 class="font-semibold truncate text-sm"> {{fake()->name}} </h5>
            </div>

            <div class="col-span-2 flex text-right justify-end">

                <button class="text-gray-500 ml-auto">
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

        <div class="my-4">
            <div class="my-2">
                <x-video/>
            </div>
        </div>
    </main>




    {{-- footer --}}


    <footer>

    </footer>
</div>