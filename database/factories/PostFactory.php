<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            '0.jpg',
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '4.jpg',
            '5.jpg',
            '6.jpg'
        ];
        return [
            'description' => fake()->text(),
            'slug'=> Str::slug(fake()->sentence(7)),
            'image' => fake()->randomElement($images),
            'user_id' => User::factory(),
        ];
    }
}
