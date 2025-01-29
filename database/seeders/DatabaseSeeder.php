<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password'=> '@user123',
        ]);
        Post::factory()->count(10)->create(['type'=>'reel']);
        Post::factory(rand(10,40))->create(['type'=>'post']);

    }
}
