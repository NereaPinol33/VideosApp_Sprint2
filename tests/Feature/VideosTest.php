<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Video;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_view_videos()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@iesebre.com',
            'password' => bcrypt('password'),
        ]);
        
        echo $user->name;

        $this->actingAs($user);

        $video = Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=video-id',
            'published_at' => now(),
        ]);

        $response = $this->get(route('videos.show', ['id' => $video->id]));

        $response->assertStatus(200);
        $response->assertViewIs('videos.show');
        $response->assertViewHas('video', $video);
    }

    public function test_users_cannot_view_not_existing_videos()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('videos.show', ['id' => 1]));

        $response->assertStatus(404);
    }
}
