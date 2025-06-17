<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use App\Models\PostAttachment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AssignBadge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            // Eager load badges to prevent multiple queries when checking with contains()
            $user->loadMissing('badges');

            // --- Post Count Badges ---
            // Badge IDs: 1 (1 post), 10 (10 posts), 11 (25 posts), 12 (50 posts)
            $postCount = $user->posts()->count();
            $postBadgeThresholds = [
                50 => 12,
                25 => 11,
                10 => 10,
                1  => 1,
            ];
            foreach ($postBadgeThresholds as $threshold => $badgeId) {
                if ($postCount >= $threshold && !$user->badges->contains($badgeId)) {
                    $user->badges()->attach($badgeId);
                    break;
                }
            }

            // --- Suara Jalanan Badge (Active Voter/Commenter) ---
            // Badge ID: 3
            // Condition: Minimum 10 combined (post votes + comment votes + comments)
            if (!$user->badges->contains(3)) {
                $userCommentsCount = $user->comments()->count();
                $userPostVotesCount = $user->votedPost()->count(); // Assumes votedPost relation counts posts user voted on
                $userCommentVotesCount = $user->votedComments()->count(); // Assumes votedComment relation counts comments user voted on

                $totalActivity = $userCommentsCount + $userPostVotesCount + $userCommentVotesCount;

                if ($totalActivity >= 20) {
                    $user->badges()->attach(3);
                }
            }

            // --- Photo Count Badges ---
            // Badge IDs: 16 (10 photos), 17 (25 photos), 18 (50 photos)
            $photoCount = PostAttachment::whereIn('post_id', $user->posts->pluck('id'))->count();
            $photoBadgeThresholds = [
                50 => 18,
                25 => 17,
                10 => 16,
            ];
            foreach ($photoBadgeThresholds as $threshold => $badgeId) {
                if ($photoCount >= $threshold && !$user->badges->contains($badgeId)) {
                    $user->badges()->attach($badgeId);
                    break;
                }
            }

            // --- Vote Count Badges ---
            // Badge IDs: 19 (20 votes), 20 (50 votes), 21 (100 votes)
            $totalPostVotes = $user->votedPost()->count(); 
            $voteBadgeThresholds = [
                100 => 21,
                50  => 20,
                20  => 19,
            ];
            foreach ($voteBadgeThresholds as $threshold => $badgeId) {
                if ($totalPostVotes >= $threshold && !$user->badges->contains($badgeId)) {
                    $user->badges()->attach($badgeId);
                    break;
                }
            }

            // --- Comment Count Badges ---
            // Badge IDs: 13 (10 comments), 14 (25 comments), 15 (50 comments)
            $commentCount = $user->comments()->count();
            $commentBadgeThresholds = [
                50 => 15,
                25 => 14,
                10 => 13,
            ];
            foreach ($commentBadgeThresholds as $threshold => $badgeId) {
                if ($commentCount >= $threshold && !$user->badges->contains($badgeId)) {
                    $user->badges()->attach($badgeId);
                    break;
                }
            }

            // --- Long Comment Count Badges ---
            // Badge IDs: 22 (5 long comments), 23 (10 long comments), 24 (20 long comments)
            $longCommentsCount = Comment::where('user_id', $user->id)
                                     ->whereRaw('LENGTH(content) >= 320')
                                     ->count();
            $longCommentBadgeThresholds = [
                20 => 24,
                10 => 23,
                5  => 22,
            ];
            foreach ($longCommentBadgeThresholds as $threshold => $badgeId) {
                if ($longCommentsCount >= $threshold && !$user->badges->contains($badgeId)) {
                    $user->badges()->attach($badgeId);
                    break;
                }
            }
            
            // Refresh user badges relation so subsequent checks in the same request cycle are up-to-date.
            // This is important if other parts of the application, after this middleware, might check badges.
            $user->load('badges');
        }

        return $next($request);
    }
}
