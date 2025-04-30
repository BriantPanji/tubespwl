<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostAttachment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'attachments', 'comments')->orderBy('created_at','desc')->withCount('upvotedBy')->get();
        $badges = User::with('badges')->get();
        // dd($posts[0]->attachments[0]->namafile);

        
        return view('home', [
            'posts' => $posts,
            'badges' => $badges,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:128',
            'content' => 'required|string|max:5120',
            'location' => 'required|string|max:512',
            'gmap_url' => 'required|string|max:512',
            'place_name' => 'required|string|max:512',
            'hashtag' => 'required|hashtag',
        ]);
        $validator->validate();

        $request->validate([
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg',
        ]);

        $hashtags = collect(explode(',', $request->hashtag))
            ->map(fn($tag) => trim(strtolower($tag)))
            ->filter()->unique()->values();

        $hashtagIds = $hashtags->map(function ($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'location' => $request->location,
            'gmap_url' => $request->gmap_url,
            'place_name' => $request->place_name,
        ]);

        $post->tag()->sync($hashtagIds);


        foreach ($request->file('images', [])  as $file) {
            if ($file) {
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('', $fileName, 'posts');

                PostAttachment::create([
                    'namafile' => $fileName,
                    'post_id' => $post->id,
                ]);
            }
        }

        return redirect('/')->with('success', 'Post created successfully');
    }

    //store comment
    public function storeComment(Request $request, $postId)
{
    $request->validate([
        'content' => 'required|string|max:2048',
    ]);

    // Create the comment
    $comment = new Comment();
    $comment->post_id = $postId;
    $comment->user_id = auth()->id();
    $comment->content = $request->content;
    $comment->save();

    return redirect()->route('post.detail', ['post' => $postId])->with('success', 'Komentar berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show($postId)
    {
        $post = Post::with('user')->withCount('votedBy')->findOrFail($postId);
        $badges = User::with('badges');
        $comments = Comment::with('user')->where('post_id', $postId)->orderBy('created_at', 'desc')->get();


        return view('post_detail', [
            'post' => $post,
            'badges' => $badges,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function upvote(Request $request, Post $post)
    {
        $user = auth()->user();

        if ($user->hasDownvotedPost($post)) {
            $user->votedPost()->detach($post);
            $user->votedPost()->attach($post, ['is_upvoted' => true]);
            return response()->json(['message' => 'Downvote removed and upvote added successfully.']);
        }

        if ($user->hasUpvotedPost($post)) {
            $user->votedPost()->detach($post);
            return response()->json(['message' => 'Upvote removed successfully.']);
        }

        $user->votedPost()->attach($post, ['is_upvoted' => true]);

        return response()->json(['message' => 'Post upvoted successfully.']);
    }

    public function downvote(Request $request, Post $post)
    {
        $user = auth()->user();

        if ($user->hasUpvotedPost($post)) {
            $user->votedPost()->detach($post);
            $user->votedPost()->attach($post, ['is_upvoted' => false]);
            return response()->json(['message' => 'Upvote removed and downvote added successfully.']);
        }

        if ($user->hasDownvotedPost($post)) {
            $user->votedPost()->detach($post);
            return response()->json(['message' => 'Downvote removed successfully.']);
        }

        $user->votedPost()->attach($post, ['is_upvoted' => false]);

        return response()->json(['message' => 'Post downvoted successfully.']);
    }

    public function bookmark(Post $post) {
        $user = auth()->user();

        if ($user->hasBookmarkedPost($post)) {
            $user->bookmarks()->detach($post->id);
        } else {
            $user->bookmarks()->attach($post->id);
        }

        return response()->json(['message' => 'Success']);

    }
}