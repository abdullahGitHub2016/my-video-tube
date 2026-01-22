<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(3),
            // Using a high-quality placeholder service for thumbnails
            'thumbnail_path' => 'https://picsum.photos/seed/' . $this->faker->uuid . '/640/360',
            // For now, we point to a sample MP4 online for testing playback
            'video_path' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
            'views' => $this->faker->numberBetween(1000, 1000000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
