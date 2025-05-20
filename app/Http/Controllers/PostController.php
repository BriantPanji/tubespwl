<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\PostAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Notifications\VoteNotification;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'attachments', 'comments')
            ->orderBy('created_at', 'desc')
            ->withCount(['upvotedBy', 'downvotedBy', 'bookmarkedBy', 'comments'])
            ->get()
            ->map(function ($post) {
                $score = ($post->upvoted_by_count * 3) +
                    ($post->downvoted_by_count * 1) -
                    ($post->comments_count * 2) +
                    ($post->bookmarks_count * 2);

                $post->weighted_score = $score + rand(0, 10);

                return $post;
            })
            ->sortByDesc('weighted_score');
        $badges = User::with('badges')->get();


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
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'location' => $request->location,
            'gmap_url' => $request->gmap_url,
            'place_name' => $request->place_name,
        ]);

        $post->tag()->sync($hashtagIds);


        foreach ($request->file('images', []) as $file) {
            if ($file) {
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('', $fileName, 'posts');

                PostAttachment::create([
                    'namafile' => $fileName,
                    'post_id' => $post->id,
                ]);
            }
        }

        $user = Auth::user();
        $postCount = $user->posts()->count();

        //Badge untuk jumlah postingan
        if ($postCount >= 50 && !$user->badges->contains(12)) {
            $user->badges()->attach(12);
        } elseif ($postCount >= 25 && !$user->badges->contains(11)) {
            $user->badges()->attach(11);
        } elseif ($postCount >= 10 && !$user->badges->contains(10)) {
            $user->badges()->attach(10);
        } elseif ($postCount == 1 && !$user->badges->contains(1)) {
            // == 1 karena post barusan baru saja dibuat
            $user->badges()->attach(1);
        }

        // Badge untuk jumlah foto
        $photoCount = PostAttachment::whereIn('post_id', $user->posts->pluck('id'))->count();
        if ($photoCount >= 50 && !$user->badges->contains(18)) {
            $user->badges()->attach(18);
        } elseif ($photoCount >= 25 && !$user->badges->contains(17)) {
            $user->badges()->attach(17);
        } elseif ($photoCount >= 10 && !$user->badges->contains(16)) {
            $user->badges()->attach(16);
        }


        return redirect('/')->with('success', 'Post created successfully');
    }

    //store comment
    // public function storeComment(Request $request, $postId)
    // {
    //     $request->validate([
    //         'content' => 'required|string|max:2048',
    //     ]);

    //     // Create the comment
    //     $comment = new Comment();
    //     $comment->post_id = $postId;
    //     $comment->user_id = auth()->id();
    //     $comment->content = $request->content;
    //     $comment->save();

    //     // badge untuk jumlah komentar
    //     $user = auth()->user();
    //     $commentCount = $user->comments()->count();

    //     if ($commentCount >= 50 && !$user->badges->contains(15)) {
    //         $user->badges()->attach(15);
    //     } elseif ($commentCount >= 25 && !$user->badges->contains(14)) {
    //         $user->badges()->attach(14);
    //     } elseif ($commentCount >= 10 && !$user->badges->contains(13)) {
    //         $user->badges()->attach(13);
    //     }

    //     $user = auth()->user();

    //     // Badge untuk jumlah komentar panjang
    //     $longCommentsCount = Comment::where('user_id', $user->id)
    //         ->whereRaw('LENGTH(content) >= 500')
    //         ->count();

    //     // badge berdasarkan jumlah komentar panjang
    //     if ($longCommentsCount >= 20 && !$user->badges->contains(24)) {
    //         $user->badges()->attach(24);
    //     } elseif ($longCommentsCount >= 10 && !$user->badges->contains(23)) {
    //         $user->badges()->attach(23);
    //     } elseif ($longCommentsCount >= 5 && !$user->badges->contains(22)) {
    //         $user->badges()->attach(22);
    //     }

    //     return redirect()->route('post.detail', ['post' => $postId])->with('success', 'Komentar berhasil ditambahkan!');
    // }


    /**
     * Display the specified resource.
     */
    public function show($postId)
    {
        $post = Post::with('user')->withCount('upvotedBy')->findOrFail($postId);
        $badges = User::with('badges');
        $comments = Comment::with('user')->withCount('upvotedBy')->where('post_id', $postId)->orderBy('upvoted_by_count', 'desc')->get();


        return view('post_detail', [
            'post' => $post,
            'badges' => $badges,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('edit-post', $post);

        return view('post.edit', compact('post'));
    }

    /**
     * Update database postingan
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('edit-post', $post);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:128',
            'content' => 'required|string|max:5120',
            'location' => 'required|string|max:512',
            'gmap_url' => 'required|string|max:512',
            'place_name' => 'required|string|max:512',
            'hashtag' => 'required|hashtag',
        ]);

        $validator->validate();
        $hashtags = collect(explode(',', $request->hashtag))
            ->map(fn($tag) => trim(strtolower($tag)))
            ->filter()->unique()->values();
        $hashtagIds = $hashtags->map(function ($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'location' => $request->location,
            'gmap_url' => $request->gmap_url,
            'place_name' => $request->place_name,
        ]);
        $post->tag()->sync($hashtagIds);

        return redirect('/')->with('success', 'Postingan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('edit-post', $post);
        $post->delete();

        return redirect('/')->with('success', 'Post deleted successfully');
    }


    public function upvote(Request $request, Post $post)
    {
        $user = Auth::user();

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

        if ($user->id !== $post->user_id) {
            $post->user->notify(new VoteNotification($user, $post));
        }

        // Badge untuk jumlah votingan
        $totalVotes = $user->votedPost()->count();

        if ($totalVotes >= 100 && !$user->badges->contains(21)) {
            $user->badges()->attach(21);
        } elseif ($totalVotes >= 50 && !$user->badges->contains(20)) {
            $user->badges()->attach(20);
        } elseif ($totalVotes >= 20 && !$user->badges->contains(19)) {
            $user->badges()->attach(19);
        }

        return response()->json(['message' => 'Post upvoted successfully.']);
    }

    public function downvote(Request $request, Post $post)
    {
        $user = Auth::user();

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
        $user = Auth::user();

        if ($user->hasBookmarkedPost($post)) {
            $user->bookmarks()->detach($post->id);
        } else {
            $user->bookmarks()->attach($post->id);
        }

        return response()->json(['message' => 'Success']);
    }

    public function report(Request $request, Post $post)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        if (Auth::user()->hasReportedPost($post)) {
            return response()->json(['message' => 'You have already reported this post.'], 403);
        }

        Auth::user()->reportedPosts()->attach($post->id, [
            'content' => $request->reason,
        ]);

        return response()->json(['message' => 'Post reported successfully.']);
    }
}
