<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="icon" type="image/svg" href="{{ asset('assets/favicon.svg') }}">
    <title>Register</title>
</head>
<body>
    <div class="flex flex-col items-center min-h-screen pt-6 sm:pt-0 bg-gray-50">
        <div class="w-full px-6 py-8 mt-6 overflow-hidden bg-white border border-gray-300 rounded-lg shadow-md sm:max-w-md">  <div class="mb-6 text-center">  <p class="text-2xl font-semibold">Sign up to see photos and videos from your friends.</p>
            </div>
            <div class="flex justify-center mb-6">
                    <x-application-logo class="w-32 h-32 text-gray-500 fill-current" />
            </div>

            <div class="mb-4">
                <button class="w-full py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">  Log in with Facebook
                </button>
            </div>

            <div class="relative flex items-center justify-center w-full mb-4">
                <div class="absolute left-0 w-full border-t border-gray-300"></div>
                <div class="relative px-4 bg-white">
                    <span class="text-sm text-gray-500">OR</span>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-2">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block w-full px-4 py-2 mt-1 leading-relaxed border border-gray-300 rounded-md" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-2">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full px-4 py-2 mt-1 leading-relaxed border border-gray-300 rounded-md" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-2">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full px-4 py-2 mt-1 leading-relaxed border border-gray-300 rounded-md" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block w-full px-4 py-2 mt-1 leading-relaxed border border-gray-300 rounded-md" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex justify-center mt-5">
                    <button class="w-full py-3 text-lg font-semibold text-white bg-gray-800 border border-transparent rounded-md hover:bg-gray-900">
                        Sign up
                    </button>
                </div>



                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500">By signing up, you agree to our <a href="#" class="text-blue-500">Terms</a>, <a href="#" class="text-blue-500">Privacy Policy</a> and <a href="#" class="text-blue-500">Cookies Policy</a>.</p>
                </div>
            </form>

            <div class="pt-6 mt-6 text-center border-t border-gray-300">  <p class="text-sm text-gray-500">Have an account? <a href="{{ route('login') }}" class="text-blue-500">Log in</a></p>
            </div>
        </div>

        <footer class="mt-6 text-center">  <p class="text-sm text-gray-500">Get the app.</p>
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
