<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostAttachment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'attachments', 'comments')->orderBy('created_at', 'desc')->withCount('upvotedBy')->get();
        $badges = User::with('badges')->get();
        // dd($posts[0]->attachments[0]->namafile);


        return view('home', [
            'posts' => $posts,
            'badges' => $badges,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $search = trim(strip_tags($search));

        // History
        if ($search) {
            $history = session()->get('search_history', []);

            // Masukkan ke awal array
            array_unshift($history, $search);

            // Hilangkan duplikat
            $history = array_unique($history);

            // Batasi jumlah history, misal 10 terakhir
            $history = array_slice($history, 0, 10);

            // Simpan kembali ke session
            session(['search_history' => $history]);
        }

        // $posts = DB::table('posts')->with('user', 'attachments', 'comments')->where('content', 'like', "%" . $search . "%")->get();
        $posts = Post::with('user', 'attachments', 'comments', 'tag')->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('gmap_url', 'like', "%{$search}%")
                ->orWhere('place_name', 'like', "%{$search}%")
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('display_name', 'like', "%{$search}%")->orWhere('username', 'like', "%{$search}%");
                })
                ->orWhereHas('tag', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
        })->withCount('upvotedBy')->get();

        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function delete_history(Request $request)
    {
        $keyword = $request->search;

        $history = session('search_history', []);
        $filtered = array_filter($history, fn($item) => $item !== $keyword);
        session(['search_history' => array_values($filtered)]);

        return response()->json(['success' => true]);
    }

    public function delete_all_history()
    {
        session()->forget('search_history');
        return response()->json(['success' => true]);
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
        $post = Post::with('user')->withCount('upvotedBy')->findOrFail($postId);
        $badges = User::with('badges');
        $comments = Comment::with('user')->withCount('votes')->where('post_id', $postId)->orderBy('votes_count', 'desc')->get();


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

    public function bookmark(Post $post)
    {
        $user = auth()->user();

        if ($user->hasBookmarkedPost($post)) {
            $user->bookmarks()->detach($post->id);
        } else {
            $user->bookmarks()->attach($post->id);
        }

        return response()->json(['message' => 'Success']);
    }
}
