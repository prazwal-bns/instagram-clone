@props([
    'source' => 'https://cdn.devdojo.com/pines/videos/coast.mp4',
    'controls' => true,
    'cover' => false,
    'autoplay' => false
])
<div
    x-data="{
        playing: false,
        muted: false,
        wasPlaying: false,
        init() {
            // Track the currently playing video
            if (!window.activeVideo) {
                window.activeVideo = null;
            }

            let observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (window.activeVideo && window.activeVideo !== this.$refs.player) {
                            window.activeVideo.pause(); // Pause the other video
                        }
                        window.activeVideo = this.$refs.player; // Set this video as active
                        if (!this.$refs.player.paused) return;
                        this.$refs.player.play();
                    } else {
                        this.$refs.player.pause();
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(this.$refs.player);

            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    this.wasPlaying = !this.$refs.player.paused;
                    this.$refs.player.pause();
                } else if (this.wasPlaying) {
                    this.$refs.player.play();
                }
            });
        }
    }"
    class="relative w-full h-full m-auto"
>
    <video
        x-ref="player"
        @play="playing = true"
        @pause="playing = false"
        @ended="$refs.player.play()"
        class="h-full max-h-[800px] m-auto w-full {{ $cover == true ? 'object-cover' : '' }}"
        @if($autoplay) autoplay @endif
        preload="metadata"
        loop
    >
        <source src="{{ $source }}" type="video/mp4">
        Your browser doesn't support HTML5 video.
    </video>

    @if ($controls == true)
        {{-- Play --}}
        <div
            x-cloak
            x-show="!playing"
            @click="$refs.player.play()"
            class="absolute inset-0 z-10 flex items-center justify-center w-full h-full cursor-pointer"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-16 h-16 text-white bi bi-play-fill" viewBox="0 0 16 16">
                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
            </svg>
        </div>

        {{-- Pause --}}
        <div
            x-show="playing"
            @click="$refs.player.pause()"
            class="absolute inset-0 z-10 flex items-center justify-center w-full h-full cursor-pointer"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="invisible w-16 h-16 text-white bi bi-pause-fill" viewBox="0 0 16 16">
                <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5"/>
            </svg>
        </div>

        {{-- Mute/Unmute --}}
        <div class="absolute z-[100] bottom-2 right-2 m-4 bg-gray-900 text-white rounded-lg p-1 cursor-pointer">
            {{-- Mute --}}
            <svg
                x-cloak
                x-show="!muted"
                @click="$refs.player.muted = true; muted = true"
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="w-4 h-4"
                viewBox="0 0 24 24"
            >
                <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM18.584 5.106a.75.75 0 011.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 11-1.06-1.06 8.25 8.25 0 000-11.668.75.75 0 010-1.06z"/>
                <path d="M15.932 7.757a.75.75 0 011.061 0 6 6 0 010 8.486.75.75 0 01-1.06-1.061 4.5 4.5 0 000-6.364.75.75 0 010-1.06z"/>
            </svg>

            {{-- Unmute --}}
            <svg
                x-show="muted"
                @click="$refs.player.muted = false; muted = false"
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="w-4 h-4"
                viewBox="0 0 24 24"
            >
                <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM17.78 9.22a.75.75 0 10-1.06 1.06L18.44 12l-1.72 1.72a.75.75 0 001.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L20.56 12l1.72-1.72a.75.75 0 00-1.06-1.06l-1.72 1.72-1.72-1.72z"/>
            </svg>
        </div>
    @endif
</div>
