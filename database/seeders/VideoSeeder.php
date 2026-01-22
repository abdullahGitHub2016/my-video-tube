<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a Test User for you to log in as
        $me = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'test@example.com',
        ]);

        // 2. Create 10 Creators
        $creators = User::factory(10)->create();

        // 3. Give each creator (including yourself) 5 videos
        $creators->push($me);

        foreach ($creators as $creator) {
            Video::factory(5)->create([
                'user_id' => $creator->id,
            ]);
        }
    }
}
