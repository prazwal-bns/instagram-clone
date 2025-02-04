<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $photos = [
            'images/person1.jpeg',
            'images/person2.jpeg',
            'images/person3.jpeg',
            'images/person4.jpeg',
            'images/person5.jpeg',
        ];

        $name = fake()->name();
        $baseUsername = Str::slug($name, '_');
        $uniqueUsername = $baseUsername . '_' . fake()->unique()->numberBetween(1000, 9999);

        return [
            'name' => $name,
            'email' => time() . fake()->unique()->safeEmail(),
            'username' => $uniqueUsername,
            'photo' => fake()->randomElement($photos),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
