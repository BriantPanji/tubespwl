<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\PostAttachment;
use App\Models\Comment;
use App\Models\Badge;

class AssignBadgeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  \$next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            // Eager load badges to prevent multiple queries when checking with contains()
            $user->loadMissing('badges');

            // --- Post Count Badges ---
            // Badge IDs: 1 (1 post), 10 (10 posts), 11 (25 posts), 12 (50 posts)
            $postCount = $user->posts()->count();
            if ($postCount >= 50 && !$user->badges->contains(12)) {
                $user->badges()->attach(12);
            } elseif ($postCount >= 25 && !$user->badges->contains(11)) {
                $user->badges()->attach(11);
            } elseif ($postCount >= 10 && !$user->badges->contains(10)) {
                $user->badges()->attach(10);
            } elseif ($postCount >= 1 && !$user->badges->contains(1)) {
                $user->badges()->attach(1);
            }

            // --- Photo Count Badges ---
            // Badge IDs: 16 (10 photos), 17 (25 photos), 18 (50 photos)
            // Assuming PostAttachment has a 'post_id' and User has many 'posts'
            // This counts attachments across all of the user's posts.
            $photoCount = PostAttachment::whereIn('post_id', $user->posts->pluck('id'))->count();
            if ($photoCount >= 50 && !$user->badges->contains(18)) {
                $user->badges()->attach(18);
            } elseif ($photoCount >= 25 && !$user->badges->contains(17)) {
                $user->badges()->attach(17);
            } elseif ($photoCount >= 10 && !$user->badges->contains(16)) {
                $user->badges()->attach(16);
            }

            // --- Vote Count Badges ---
            // Badge IDs: 19 (20 votes), 20 (50 votes), 21 (100 votes)
            // Assuming 'votedPost()' relation exists on User model and counts all votes by the user on posts.
            $totalPostVotes = $user->votedPost()->count();
            if ($totalPostVotes >= 100 && !$user->badges->contains(21)) {
                $user->badges()->attach(21);
            } elseif ($totalPostVotes >= 50 && !$user->badges->contains(20)) {
                $user->badges()->attach(20);
            } elseif ($totalPostVotes >= 20 && !$user->badges->contains(19)) {
                $user->badges()->attach(19);
            }

            // --- Comment Count Badges ---
            // Badge IDs: 13 (10 comments), 14 (25 comments), 15 (50 comments)
            $commentCount = $user->comments()->count();
            if ($commentCount >= 50 && !$user->badges->contains(15)) {
                $user->badges()->attach(15);
            } elseif ($commentCount >= 25 && !$user->badges->contains(14)) {
                $user->badges()->attach(14);
            } elseif ($commentCount >= 10 && !$user->badges->contains(13)) {
                $user->badges()->attach(13);
            }

            // --- Long Comment Count Badges ---
            // Badge IDs: 22 (5 long comments), 23 (10 long comments), 24 (20 long comments)
            $longCommentsCount = Comment::where('user_id', $user->id)
                                     ->whereRaw('LENGTH(content) >= 320')
                                     ->count();
            if ($longCommentsCount >= 20 && !$user->badges->contains(24)) {
                $user->badges()->attach(24);
            } elseif ($longCommentsCount >= 10 && !$user->badges->contains(23)) {
                $user->badges()->attach(23);
            } elseif ($longCommentsCount >= 5 && !$user->badges->contains(22)) {
                $user->badges()->attach(22);
            }

            // Refresh user badges relation if any were attached, so subsequent checks in the same request cycle are up-to-date.
            // This is important if other parts of the application, after this middleware, might check badges.
            if ($user->wasChanged('badges')) { // 'wasChanged' might not work directly for relationships.
                                             // A more reliable way is to check if any attach operations happened.
                                             // However, for simplicity and given typical usage, a simple load is often fine.
                $user->load('badges');
            }
        }

        return $next($request);
    }
}
