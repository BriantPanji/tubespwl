<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Badge;
use App\Http\Middleware\AssignBadgeMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BadgeAssignmentTest extends TestCase
{
    use RefreshDatabase; // Ensures database is reset for each test

    /** @test */
    public function test_assigns_langkah_pertama_badge_after_first_post()
    {
        // 1. Create prerequisite badges if they don't exist from seeding (especially badge ID 1)
        Badge::firstOrCreate(
            ['id' => 1],
            [
                'badge_name' => 'Langkah Pertama',
                'badge_desc' => 'Untuk pengguna yang baru pertama kali membagikan tempat',
                'badge_color' => '#CC2B2B',
                'badge_icon' => 'langkah_pertama.png',
                'point' => 1,
            ]
        );
        // Add other badges needed by the middleware if they could be assigned.
        // For this specific test focusing on badge ID 1, these might not be strictly necessary
        // if the conditions for them aren't met by creating a single post without attachments/votes/comments.
        // However, including them makes the setup more robust if PostFactory or other actions
        // inadvertently trigger conditions for other badges.
        Badge::firstOrCreate(['id' => 10], ['badge_name' => 'Penjelajah Rasa I', 'point' => 16, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 11], ['badge_name' => 'Penjelajah Rasa II', 'point' => 17, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 12], ['badge_name' => 'Penjelajah Rasa III', 'point' => 18, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);

        Badge::firstOrCreate(['id' => 16], ['badge_name' => 'Lensa Kota I', 'point' => 18, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 17], ['badge_name' => 'Lensa Kota II', 'point' => 19, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 18], ['badge_name' => 'Lensa Kota III', 'point' => 20, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);

        // Badge IDs for votes (19, 20, 21)
        Badge::firstOrCreate(['id' => 19], ['badge_name' => 'Sentuh Rasa I', 'point' => 3, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 20], ['badge_name' => 'Sentuh Rasa II', 'point' => 4, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 21], ['badge_name' => 'Sentuh Rasa III', 'point' => 5, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);

        // Badge IDs for comments (13, 14, 15)
        Badge::firstOrCreate(['id' => 13], ['badge_name' => 'Suara Halus I', 'point' => 10, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 14], ['badge_name' => 'Suara Halus II', 'point' => 11, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 15], ['badge_name' => 'Suara Halus III', 'point' => 12, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);

        // Badge IDs for long comments (22, 23, 24)
        Badge::firstOrCreate(['id' => 22], ['badge_name' => 'Cerita Jalan I', 'point' => 13, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 23], ['badge_name' => 'Cerita Jalan II', 'point' => 14, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);
        Badge::firstOrCreate(['id' => 24], ['badge_name' => 'Cerita Jalan III', 'point' => 15, 'badge_desc' => 'desc', 'badge_color' => '#color', 'badge_icon' => 'icon.png']);


        // 2. Create a user
        $user = User::factory()->create();

        // 3. Authenticate the user for the middleware
        Auth::login($user); // Effectively $this->actingAs($user) for middleware context

        // 4. Create the first post for this user
        // Ensure PostFactory does not create related data (attachments, comments, votes) by default
        // that might trigger other badges, unless that's part of a more complex test.
        $post = Post::factory()->create(['user_id' => $user->id]);

        // At this point, the user has 1 post, 0 photos (assuming PostFactory default), 0 votes, 0 comments.

        // 5. Instantiate the middleware
        $middleware = new AssignBadgeMiddleware();

        // 6. Create a mock request and set the user
        $request = Request::create('/', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });


        // 7. Execute the middleware's handle method
        $response = $middleware->handle($request, function ($req) {
            return new Response(); // Return a simple response for the next() call
        });

        // 8. Refresh user from DB to get any updated relations (like badges)
        $user->refresh();

        // 9. Assert that the user has the 'Langkah Pertama' badge (ID 1)
        $this->assertTrue($user->badges->contains(1), "User should have 'Langkah Pertama' badge (ID 1) after their first post.");

        // Optional: Assert that other badges (e.g., for 10 posts, or for photos) are NOT assigned yet
        $this->assertFalse($user->badges->contains(10), "User should NOT have 'Penjelajah Rasa I' badge (ID 10) yet.");
        $this->assertFalse($user->badges->contains(16), "User should NOT have 'Lensa Kota I' badge (ID 16) yet if no photos were attached.");
    }
}
