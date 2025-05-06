<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function upvote(Request $request, Comment $comment)
    {
        $user = auth()->user();

        if ($user->hasDownvotedComment($comment)) {
            $user->votedComments()->detach($comment);
            $user->votedComments()->attach($comment, ['is_upvoted' => true]);
            return response()->json(['message' => 'Downvote removed and upvote added successfully.']);
        }

        if ($user->hasUpvotedComment($comment)) {
            $user->votedComments()->detach($comment);
            return response()->json(['message' => 'Upvote removed successfully.']);
        }

        $user->votedComments()->attach($comment, ['is_upvoted' => true]);

        return response()->json(['message' => 'Post upvoted successfully.']);
    }

    public function downvote(Request $request, Comment $comment)
    {
        $user = auth()->user();

        if ($user->hasUpvotedComment($comment)) {
            $user->votedComments()->detach($comment);
            $user->votedComments()->attach($comment, ['is_upvoted' => false]);
            return response()->json(['message' => 'Upvote removed and downvote added successfully.']);
        }

        if ($user->hasDownvotedComment($comment)) {
            $user->votedComments()->detach($comment);
            return response()->json(['message' => 'Downvote removed successfully.']);
        }

        $user->votedComments()->attach($comment, ['is_upvoted' => false]);

        return response()->json(['message' => 'Post downvoted successfully.']);
    }
}
