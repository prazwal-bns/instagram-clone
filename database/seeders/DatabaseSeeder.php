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
        $photos = [
            'images/person1.jpeg',
            'images/person2.jpeg',
            'images/person3.jpeg',
            'images/person4.jpeg',
            'images/person5.jpeg',
        ];

        User::factory()->create([
            'name' => 'User 1',
            'username' => 'user_1',
            'photo' => fake()->randomElement($photos),
            'email' => 'user1@gmail.com',
            'password'=> '@user123',
        ]);

        User::factory()->create([
            'name' => 'User 2',
            'username' => 'user_2',
            'photo' => fake()->randomElement($photos),
            'email' => 'user2@gmail.com',
            'password'=> '@user123',
        ]);

        Post::factory(20)->hasComments(rand(20,20))->create(['type'=>'post']);
        Post::factory(12)->hasComments(rand(15,20))->create(['type'=>'reel']);

        // Create comment replies
        Comment::limit(50)->each(function($comment){

            $comment::factory(rand(1,5))->isReply($comment->commentable)->create(['parent_id'=>$comment->id]);


        });

        Post::factory()->hasComments(1)->create(['type' => 'post']);
        $post = Post::factory()->hasComments(1)->create(['type' => 'post']);

        // Create nested comments
        $parentComment = $post->comments->first();

        for ($i = 0; $i < 10; $i++) {
            $nestedComment = Comment::factory()->isReply($parentComment->commentable)->create(['parent_id' => $parentComment->id]);
            $parentComment = $nestedComment; // Set the new comment as the parent for the next iteration
        }

    }
}
