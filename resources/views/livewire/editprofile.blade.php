<div class="max-w-4xl mx-auto p-14">
    <h1 class="mb-8 text-2xl font-bold">Edit profile</h1>
        <!-- Profile Photo Section -->
        <div class="flex items-center justify-between p-4 mb-6 bg-gray-100 rounded-lg">
            <div class="relative flex items-center gap-4">
                <!-- Hidden file input -->
                <input
                    type="file"
                    id="profile-photo"
                    class="hidden"
                    accept="image/*"
                    wire:model="photo"
                >

                <!-- Clickable avatar wrapper -->
                <div class="relative w-20 h-20 cursor-pointer group" onclick="document.getElementById('profile-photo').click()">
                    <!-- Avatar image -->
                    <x-avatar
                        id="avatar-preview"
                        class="object-cover w-full h-full transition duration-200 rounded-full group-hover:opacity-75"
                        :src="$photo ? $photo->temporaryUrl() : (auth()->user()->photo ? asset(auth()->user()->photo) : null)"
                        alt="Profile photo"
                    />

                    <!-- Hover overlay -->
                    <div class="absolute inset-0 flex items-center justify-center transition duration-200 bg-black bg-opacity-0 rounded-full group-hover:bg-opacity-30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>

                <!-- User details -->
                <div>
                    <h2 class="flex items-center font-semibold truncate">{{ auth()->user()->username }}
                        @if(auth()->user()->is_verified)
                            <span class="pl-2 text-blue-500">
                                <svg aria-label="Verified" class="x1lliihq x1n2onr6" fill="rgb(0, 149, 246)" height="20" role="img" viewBox="0 0 40 40" width="20">
                                    <title>Verified</title>
                                    <path d="M19.998 3.094 14.638 0l-2.972 5.15H5.432v6.354L0 14.64 3.094 20 0 25.359l5.432 3.137v5.905h5.975L14.638 40l5.36-3.094L25.358 40l3.232-5.6h6.162v-6.01L40 25.359 36.905 20 40 14.641l-5.248-3.03v-6.46h-6.419L25.358 0l-5.36 3.094Zm7.415 11.225 2.254 2.287-11.43 11.5-6.835-6.93 2.244-2.258 4.587 4.581 9.18-9.18Z" fill-rule="evenodd"></path>
                                </svg>
                            </span>
                        @endif
                    </h2>
                    <p class="text-sm text-gray-600">{{ auth()->user()->name }}
                    </p>
                </div>
            </div>

            <button
                type="submit"
                class="px-4 py-2 text-sm text-white {{ $photo ? 'bg-blue-500 hover:bg-blue-600' : 'bg-gray-400 cursor-not-allowed' }} rounded-lg transition duration-200"
                wire:click="savePhoto"
                @if(!$photo) disabled @endif
            >
                {{ $photo ? 'Save Photo' : 'Change Photo' }}
            </button>

        </div>

        <form wire:submit.prevent="updateProfile">
            @csrf
            <!-- Name Section -->
            <div class="mb-6">
                <label class="block mb-2 font-medium">Name</label>
                <input
                    type="text"
                    name="name"
                    wire:model="name"
                    class="w-full p-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your name "
                >
            </div>

            <!-- Website Section -->
            {{-- <div class="mb-6">
                <label class="block mb-2 font-medium">Website</label>
                <input
                    type="url"
                    name="website"
                    wire:model="website"
                    class="w-full p-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your website URL"
                >
            </div> --}}

            <!-- Website Input Field -->
            <div class="relative mb-6">
                <label class="block mb-2 font-medium">Website <span class="text-sm text-gray-400">optional</span></label>

                <div class="flex items-center space-x-3">
                    <!-- Website Name -->
                    <input type="text"
                        name="website"
                        wire:model="website"
                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter website name"
                    >

                    <!-- Link Button -->
                    <button type="button"
                        onclick="document.getElementById('website_modal').classList.remove('hidden')"
                        class="flex items-center px-4 py-2 text-gray-500 border rounded-lg hover:bg-gray-100"
                    >
                        🔗 Link
                    </button>

                    <!-- Delete Button -->
                    <button type="button"
                        class="flex items-center px-4 py-2 text-red-500 border rounded-lg hover:bg-red-100"
                    >
                        🗑️
                    </button>
                </div>
            </div>

            <!-- Modal for Link URL -->
            <div id="website_modal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50 backdrop-blur-sm">
                <div class="p-6 bg-white rounded-lg shadow-xl w-96">
                    <h2 class="mb-3 text-lg font-semibold">Link URL</h2>

                    <input type="url"
                        wire:model="website_link"
                        class="w-full p-3 bg-gray-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter Link"
                    >

                    <div class="flex justify-between mt-4">
                        <button type="button"
                            onclick="document.getElementById('website_modal').classList.add('hidden')"
                            class="px-4 py-2 text-gray-500 border rounded-lg hover:bg-gray-100"
                        >
                            Cancel
                        </button>

                        <button type="button"
                            onclick="document.getElementById('website_modal').classList.add('hidden')"
                            class="px-4 py-2 text-white rounded-lg bg-gradient-to-r from-pink-500 to-red-500"
                        >
                            Add
                        </button>
                    </div>
                </div>
            </div>




            <!-- Email Section -->

            <!-- Address Section -->
            <div class="mb-6">
                <label class="block mb-2 font-medium">Address</label>
                <input
                    type="text"
                    name="address"
                    wire:model="address"
                    class="w-full p-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your address"
                >
            </div>

            <!-- Bio Section -->
            <div class="mb-6">
                <label class="block mb-2 font-medium">Bio</label>
                <div class="">
                    <textarea
                        name="bio"
                        wire:model="bio"
                        rows="3"
                        maxlength="150"
                        class="w-full p-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-blue-500"
                    ></textarea>
                    <div class="absolute text-sm text-gray-500 bottom-2 right-2">
                        <span x-text="$refs.bio.value.length"></span>/150
                    </div>
                </div>
            </div>

            <!-- Gender Selection -->
            <div class="mb-6">
                <label class="block mb-2 font-medium">Gender</label>
                <select
                    wire:model="gender"
                    name="gender"
                    class="w-full p-3 bg-gray-100 border-0 rounded-lg appearance-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="male" >Male</option>
                    <option value="female")>Female</option>
                    <option value="other")>Other</option>
                </select>
                <p class="mt-2 text-sm text-gray-500">
                    This won't be part of your public profile.
                </p>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Save changes
            </button>
        </form>



</div>
