<?php

namespace Database\Seeders;

use App\Models\Comment;
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

        Post::factory(20)->hasComments(rand(20,20))->create(['type'=>'post']);
        Post::factory(12)->hasComments(rand(15,20))->create(['type'=>'reel']);

        // Create comment replies
        Comment::limit(50)->each(function($comment){

            $comment::factory(rand(1,5))->isReply($comment->commentable)->create(['parent_id'=>$comment->id]);


        });
    }
}
