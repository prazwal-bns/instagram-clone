<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="icon" type="image/svg" href="{{ asset('assets/favicon.svg') }}">
    <title>Login</title>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex flex-col items-center justify-center min-h-screen">  <div class="w-full px-6 py-8 mt-6 overflow-hidden bg-white border border-gray-300 rounded-lg shadow-md sm:max-w-md">
            <div class="mb-6 text-center">
                <p class="text-2xl font-semibold">Log in to see photos and videos from your friends.</p>
            </div>
            <div class="flex justify-center mb-6">
                 <x-application-logo class="w-32 h-32 text-gray-500 fill-current" />
            </div>

            <div class="mb-4">
                <a href="{{ route('socialite.redirect', 'facebook') }}" class="block w-full py-2 font-bold text-center text-white bg-blue-500 rounded hover:bg-blue-700">
                    Log in with Facebook
                </a>
            </div>

            <div class="relative flex items-center justify-center w-full mb-4">
                <div class="absolute left-0 w-full border-t border-gray-300"></div>
                <div class="relative px-4 bg-white">
                    <span class="text-sm text-gray-500">OR</span>
                </div>
            </div>


            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Phone number, username, or email')" />
                    <x-text-input id="email" class="block w-full px-4 py-2 mt-1 leading-relaxed border border-gray-300 rounded-md" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full px-4 py-2 mt-1 leading-relaxed border border-gray-300 rounded-md" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex justify-center mt-5">
                    <button class="w-full py-3 text-lg font-semibold text-white bg-gray-800 border border-transparent rounded-md hover:bg-gray-900">
                        Log in
                    </button>
                </div>

                <div class="mt-6 text-center">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>

            <div class="pt-6 mt-8 text-center border-t border-gray-300">
                <p class="text-sm text-gray-500">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Sign up</a></p>
            </div>
        </div>

        <footer class="mt-6 text-center">
            <p class="text-sm text-gray-500">Get the app.</p>
            <div class="flex justify-center mt-2">
                <a href="#">
                    <img src="https://static.cdninstagram.com/rsrc.php/v4/yt/r/Yfc020c87j0.png" alt="Download on the App Store" class="h-10">
                </a>
                <a href="#" class="ml-2">
                    <img src="https://static.cdninstagram.com/rsrc.php/v4/yz/r/c5Rp7Ym-Klz.png" alt="GET IT ON Google Play" class="h-10">
                </a>
            </div>
        </footer>
    </div>
</body>
</html>
