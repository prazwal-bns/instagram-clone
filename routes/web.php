<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Livewire\Chat\Index;
use App\Livewire\Editprofile;
use App\Livewire\Explore;
use App\Livewire\Home;
use App\Livewire\Post\View\Page;
use App\Livewire\Profile\Home as ProfileHome;
use App\Livewire\Profile\Reels;
use App\Livewire\Profile\Saved;
use App\Livewire\Reels as LivewireReels;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', Home::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->name('socialite.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', Home::class)->name('home');
    Route::get('/explore', Explore::class)->name('explore');
    Route::get('/reels', LivewireReels::class)->name('reels');
    Route::get('/post/{post}', Page::class)->name('post');

    Route::get('/chat',Index::class)->name('chat');

    Route::get('/edit/my-profile', Editprofile::class)->name('edit.my-profile');

    Route::get('/profile/{user}', ProfileHome::class)->name('profile.home');
    Route::get('/profile/{user}/reels', Reels::class)->name('profile.reels');
    Route::get('/profile/{user}/saved', Saved::class)->name('profile.saved');
});

require __DIR__.'/auth.php';
