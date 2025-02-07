<div class="max-w-4xl mx-auto p-14">
    <h1 class="mb-8 text-2xl font-bold">Edit profile</h1>

    <form enctype="multipart/form-data">
        <!-- Profile Photo Section -->
        <div class="flex items-center justify-between p-4 mb-6 bg-gray-100 rounded-lg">
            <div class="flex items-center gap-4">
                <!-- Hidden file input -->
                <input
                    type="file"
                    id="profile-photo"
                    class="hidden"
                    accept="image/*"
                    wire:model="photo"
                >

                <!-- Clickable avatar wrapper -->
                <div
                    class="relative cursor-pointer group"
                    onclick="document.getElementById('profile-photo').click()"
                >
                    <x-avatar
                        id="avatar-preview"
                        class="object-cover w-16 h-16 transition duration-200 rounded-full group-hover:opacity-75"
                        :src="auth()->user()->photo ? asset(auth()->user()->photo) : null"
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

                <div>
                    <h2 class="font-medium">{{ auth()->user()->username }}</h2>
                    <p class="text-sm text-gray-600">{{ auth()->user()->name }}</p>
                </div>
            </div>
            <button
                type="submit"
                class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600"
            >
                Change Photo
            </button>
        </div>

        <!-- Email Section -->
        <div class="mb-6">
            <label class="block mb-2 font-medium">Email</label>
            <input
                type="url"
                name="email"
                value="{{ old('email', auth()->user()->email) }}"
                class="w-full p-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="Enter your email URL"
            >
        </div>

        <!-- Address Section -->
        <div class="mb-6">
            <label class="block mb-2 font-medium">Address</label>
            <input
                type="url"
                name="address"
                value="{{ old('address', auth()->user()->address) }}"
                class="w-full p-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="Enter your address"
            >
        </div>

        <!-- Bio Section -->
        <div class="mb-6">
            <label class="block mb-2 font-medium">Bio</label>
            <div class="relative">
                <textarea
                    name="bio"
                    rows="3"
                    maxlength="150"
                    class="w-full p-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-blue-500"
                >{{ old('bio', auth()->user()->bio) }}</textarea>
                <div class="absolute text-sm text-gray-500 bottom-2 right-2">
                    <span x-text="$refs.bio.value.length"></span>/150
                </div>
            </div>
        </div>

        <!-- Gender Selection -->
        <div class="mb-6">
            <label class="block mb-2 font-medium">Gender</label>
            <select
                name="gender"
                class="w-full p-3 bg-gray-100 border-0 rounded-lg appearance-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="male" @selected(auth()->user()->gender === 'male')>Male</option>
                <option value="female" @selected(auth()->user()->gender === 'female')>Female</option>
                <option value="other" @selected(auth()->user()->gender === 'other')>Other</option>
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

    <script>
        document.addEventListener('livewire:load', function () {
            const input = document.getElementById('profile-photo');
            const preview = document.getElementById('avatar-preview');

            input.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</div>
