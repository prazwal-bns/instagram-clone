<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Define 5 image URLs and 5 video URLs
        $imageUrls = [
            'https://www.w3schools.com/w3images/fjords.jpg',
            'https://www.w3schools.com/w3images/mountains.jpg',
            'https://www.w3schools.com/w3images/lights.jpg',
            'https://www.w3schools.com/w3images/forest.jpg',
            'https://www.w3schools.com/w3images/snow.jpg',
        ];

        $videoUrls = [
            'https://www.w3schools.com/html/mov_bbb.mp4',
            'https://www.sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4',
            'https://www.learningcontainer.com/wp-content/uploads/2020/05/sample-mp4-file.mp4',
            'https://www.sample-videos.com/video123/mp4/720/big_buck_bunny_720p_5mb.mp4',
            'https://www.w3schools.com/html/movie.mp4',
        ];

        // Randomly select between an image or a video
        $mediaType = $this->faker->randomElement(['image', 'video']);

        if ($mediaType === 'image') {
            // Randomly select an image URL from the array
            $mediaUrl = $this->faker->randomElement($imageUrls);
        } else {
            // Randomly select a video URL from the array
            $mediaUrl = $this->faker->randomElement($videoUrls);
        }

        return [
            'user_id' => User::factory(),
            'media_type' => $mediaType,
            'media_url' => $mediaUrl,
            'text' => $this->faker->optional(0.7)->sentence,
            'expires_at' => Carbon::now()->addHours(24),
        ];
    }
}
