<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Notifications\CommentNotification;
use App\Notifications\VoteCommentNotification;

class CommentController extends Controller
{

    //store comment
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:2048',
        ]);

        // Create the comment
        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = Auth::id();
        $comment->content = $request->content;
        $comment->save();

        if ($comment->user->id !== $comment->post->user_id) {
            $comment->post->user->notify(new CommentNotification($comment->user, $comment));
        }

        return redirect()->route('post.detail', ['post' => $postId])->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function upvote(Request $request, Comment $comment)
    {
        $user = Auth::user();

        if ($user->hasDownvotedComment($comment)) {
            $user->votedComments()->detach($comment);
            $user->votedComments()->attach($comment, ['is_upvoted' => true]);
            return response()->json(['message' => 'Downvote removed and upvote added successfully.']);
        }

        if ($user->hasUpvotedComment($comment)) {
            $user->votedComments()->detach($comment);
            return response()->json(['message' => 'Upvote removed successfully.']);
        }

        if ($user->id !== $comment->user_id) {
            $comment->user->notify(new VoteCommentNotification($user, $comment));
        }

        $user->votedComments()->attach($comment, ['is_upvoted' => true]);

        return response()->json(['message' => 'Post upvoted successfully.']);
    }

    public function downvote(Request $request, Comment $comment)
    {
        $user = Auth::user();

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

    public function report(Request $request, Comment $comment)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        if (Auth::user()->hasReportedComment($comment)) {
            return response()->json(['message' => 'You have already reported this comment.'], 403);
        }
        Auth::user()->reportedComments()->attach($comment->id, [
            'content' => $request->reason,
        ]);


        return response()->json(['message' => 'Comment reported successfully.']);
    }
    public function destroy(Request $request, Comment $comment)
    {
        Gate::authorize('edit-comment', $comment);

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully.']);
    }
}
