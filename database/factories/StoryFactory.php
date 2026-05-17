<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageUrls = [
            'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1080&h=1920&fit=crop',
            'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1080&h=1920&fit=crop',
            'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=1080&h=1920&fit=crop',
            'https://images.unsplash.com/photo-1682687220742-aba13b6e50ba?w=1080&h=1920&fit=crop',
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1080&h=1920&fit=crop',
        ];

        return [
            'user_id' => User::factory(),
            'media_type' => 'image',
            'media_url' => $this->faker->randomElement($imageUrls),
            'text' => $this->faker->optional(0.7)->sentence,
            'expires_at' => Carbon::now()->addHours(24),
        ];
    }
}
