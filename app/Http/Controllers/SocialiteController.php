<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    // public function callback(string $provider)
    // {
    //     $response = Socialite::driver($provider)->stateless()->user();
    //     // dd($response);
    //         $user = User::firstWhere('email', $response->getEmail());
    //         if ($user) {
    //             // $user->update([$provider . '_id' => $response->getId()]);
    //             auth()->login($user, true);
    //         } else {
    //             $username = $this->generateUniqueUsername($response->getName());

    //             $user = User::create([
    //                 $provider . '_id' => $response->getId(),
    //                 'name' => $response->getName(),
    //                 'username' => $username,
    //                 'email' => $response->getEmail(),
    //                 'photo' => $response->getAvatar(),
    //                 'password' => 'password',
    //             ]);
    //         }
    //         Auth::login($user);
    //         return redirect()->intended(route('home'));
    // }

    public function callback(string $provider)
    {
        if (request()->has('error')) {
            return redirect()->route('home')->with('error', 'Facebook login canceled or failed');
        }

        try {
            $response = Socialite::driver($provider)->stateless()->user();

            $user = User::firstWhere('email', $response->getEmail());

            if ($user) {
                auth()->login($user, true);
            } else {
                $username = $this->generateUniqueUsername($response->getName());

                $user = User::create([
                    $provider . '_id' => $response->getId(),
                    'name' => $response->getName(),
                    'username' => $username,
                    'email' => $response->getEmail(),
                    'photo' => $response->getAvatar(),
                    'password' => 'password',
                ]);
            }

            Auth::login($user);
            return redirect()->intended(route('home'));

        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'There was an issue with the Facebook login');
        }
    }



    public function generateUniqueUsername($name)
    {
        $baseUsername = Str::slug($name, '_');
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . '_' . $counter;
            $counter++;
        }

        return $username;
    }
}
