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
        $user = Auth::user();

        $posts = Post::with('user.badges', 'attachments', 'comments')
            ->orderBy('created_at', 'desc')
            ->withCount(['upvotedBy', 'downvotedBy', 'bookmarkedBy', 'comments'])
            ->paginate(10);

        $posts->getCollection()->transform(function ($post) use ($user) {
            $score = ($post->upvoted_by_count * 3) +
                    ($post->downvoted_by_count * 1) -
                    ($post->comments_count * 2) +
                    ($post->bookmarks_count * 2);

                $post->weighted_score = $score; // + rand(0, 10);

                if (Auth::check()) {
                    $authedUser = Auth::user();
                    $post->upvoted_by_user = $authedUser->hasUpvotedPost($post);
                    $post->downvoted_by_user = $authedUser->hasDownvotedPost($post);
                    $post->bookmarked_by_user = $authedUser->hasBookmarkedPost($post);
                } else {
                    $post->upvoted_by_user = false;
                    $post->downvoted_by_user = false;
                    $post->bookmarked_by_user = false;
                }

                $post->allow_edit = Gate::allows('edit-post', $post);
                return $post;
            });

        $oneMinuteAgo = now()->subMinute();
        $processedPosts = $posts->getCollection();

        if ($user) {
            $recentUserPosts = $processedPosts->filter(function ($post) use ($user, $oneMinuteAgo) {
                return $post->user_id === $user->id && $post->created_at > $oneMinuteAgo;
            })->sortByDesc('created_at');

            $otherPosts = $processedPosts->diff($recentUserPosts)->sortByDesc('weighted_score');

            $mergedPosts = $recentUserPosts->merge($otherPosts);
        } else {
            $mergedPosts = $processedPosts->sortByDesc('weighted_score');
        }

        // Replace the collection in the paginator instance
        $posts->setCollection($mergedPosts->values());

        $badges = User::with('badges')->get();


        return view('home', [
            'posts' => $posts,
            'badges' => $badges,
        ]);
    }

    public function loadMorePosts(Request $request)
    {
        $user = Auth::user();
        $page = $request->page ?? 1;

        $posts = Post::with('user.badges', 'attachments', 'comments')
            ->orderBy('created_at', 'desc')
            ->withCount(['upvotedBy', 'downvotedBy', 'bookmarkedBy', 'comments'])
            ->paginate(10, ['*'], 'page', $page);

        $posts->getCollection()->transform(function ($post) use ($user) {
            $score = ($post->upvoted_by_count * 3) +
                ($post->downvoted_by_count * 1) -
                ($post->comments_count * 2) +
                ($post->bookmarks_count * 2);

            $post->weighted_score = $score;//  + rand(0, 10);

            if (Auth::check()) {
                $authedUser = Auth::user(); // $user is already available in this method's scope, but using $authedUser to avoid conflict if any scope issue.
                $post->upvoted_by_user = $authedUser->hasUpvotedPost($post);
                $post->downvoted_by_user = $authedUser->hasDownvotedPost($post);
                $post->bookmarked_by_user = $authedUser->hasBookmarkedPost($post);
            } else {
                $post->upvoted_by_user = false;
                $post->downvoted_by_user = false;
                $post->bookmarked_by_user = false;
            }

            $post->allow_edit = Gate::allows('edit-post', $post);
            return $post;
        });

        $oneMinuteAgo = now()->subMinute();
        $processedPosts = $posts->getCollection();

        if ($user) {
            $recentUserPosts = $processedPosts->filter(function ($post) use ($user, $oneMinuteAgo) {
                return $post->user_id === $user->id && $post->created_at > $oneMinuteAgo;
            })->sortByDesc('created_at');

            $otherPosts = $processedPosts->diff($recentUserPosts)->sortByDesc('weighted_score');

            $mergedPosts = $recentUserPosts->merge($otherPosts);
        } else {
            $mergedPosts = $processedPosts->sortByDesc('weighted_score');
        }

        // Replace the collection in the paginator instance
        $posts->setCollection($mergedPosts->values());

        return response()->json($posts);
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
//        $posts = Post::with('user', 'attachments', 'comments', 'tag')->where(function ($query) use ($search) {
//            $query->where('title', 'like', "%{$search}%")
//                ->orWhere('content', 'like', "%{$search}%")
//                ->orWhere('location', 'like', "%{$search}%")
//                ->orWhere('gmap_url', 'like', "%{$search}%")
//                ->orWhere('place_name', 'like', "%{$search}%")
//                ->orWhereHas('user', function ($query) use ($search) {
//                    $query->where('display_name', 'like', "%{$search}%")->orWhere('username', 'like', "%{$search}%");
//                })
//                ->orWhereHas('tag', function ($query) use ($search) {
//                    $query->where('name', 'like', "%{$search}%");
//                });
//        })->withCount('upvotedBy')->get();

        $user = Auth::user();

        $posts = Post::with('user.badges', 'attachments', 'comments')
            ->orderBy('created_at', 'desc')
            ->withCount(['upvotedBy', 'downvotedBy', 'bookmarkedBy', 'comments'])
            ->where('title', 'like', "%$search%")
            ->orWhere('content', 'like', "%{$search}%")
            ->orWhere('location', 'like', "%{$search}%")
            ->orWhere('gmap_url', 'like', "%{$search}%")
            ->orWhere('place_name', 'like', "%{$search}%")
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('display_name', 'like', "%{$search}%")->orWhere('username', 'like', "%{$search}%");
            })
            ->orWhereHas('tag', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        $posts->getCollection()->transform(function ($post) use ($user) {
            $score = ($post->upvoted_by_count * 3) +
                ($post->downvoted_by_count * 1) -
                ($post->comments_count * 2) +
                ($post->bookmarks_count * 2);

            $post->weighted_score = $score + rand(0, 10);

            if (Auth::check()) {
                $authedUser = Auth::user();
                $post->upvoted_by_user = $authedUser->hasUpvotedPost($post);
                $post->downvoted_by_user = $authedUser->hasDownvotedPost($post);
                $post->bookmarked_by_user = $authedUser->hasBookmarkedPost($post);
            } else {
                $post->upvoted_by_user = false;
                $post->downvoted_by_user = false;
                $post->bookmarked_by_user = false;
            }

            $post->allow_edit = Gate::allows('edit-post', $post);
            return $post;
        });

        $oneMinuteAgo = now()->subMinute();
        $processedPosts = $posts->getCollection();

        if ($user) {
            $recentUserPosts = $processedPosts->filter(function ($post) use ($user, $oneMinuteAgo) {
                return $post->user_id === $user->id && $post->created_at > $oneMinuteAgo;
            })->sortByDesc('created_at');

            $otherPosts = $processedPosts->diff($recentUserPosts)->sortByDesc('weighted_score');

            $mergedPosts = $recentUserPosts->merge($otherPosts);
        } else {
            $mergedPosts = $processedPosts->sortByDesc('weighted_score');
        }

        // Replace the collection in the paginator instance
        $posts->setCollection($mergedPosts->values());

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

    /**
     * Display the specified resource.
     */
    public function show($postId)
    {
        $user = Auth::user();

        $post = Post::with(['user', 'tag'])->withCount('upvotedBy')->findOrFail($postId);
        $badges = User::with('badges')->get();
        $comments = Comment::with('user')->withCount('upvotedBy')->where('post_id', $postId)->get();

        if ($user) {
            $userComments = $comments->filter(function($c) use ($user) {
                return $c->user_id === $user->id;
            })->sortByDesc('created_at');

            $otherComments = $comments->reject(function($c) use ($user) {
                return $c->user_id === $user->id;
            })->sortByDesc('upvoted_by_count');

            $mergedComments = $userComments->merge($otherComments);
        } else {
            $mergedComments = $comments->sortByDesc('upvoted_by_count');
        }

        return view('post_detail', [
            'post' => $post,
            'badges' => $badges,
            'comments' => $mergedComments,
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
            $post->refresh();
            return response()->json([
                'message' => 'Downvote removed and upvote added successfully.',
                'upvoted_by_count' => $post->upvotedBy()->count(),
                'downvoted_by_count' => $post->downvotedBy()->count(),
                'upvoted_by_user' => true,
                'downvoted_by_user' => false
            ]);
        }

        if ($user->hasUpvotedPost($post)) {
            $user->votedPost()->detach($post);
            $post->refresh();
            return response()->json([
                'message' => 'Upvote removed successfully.',
                'upvoted_by_count' => $post->upvotedBy()->count(),
                'downvoted_by_count' => $post->downvotedBy()->count(),
                'upvoted_by_user' => false,
                'downvoted_by_user' => false
            ]);
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

        $post->refresh();
        return response()->json([
            'message' => 'Post upvoted successfully.',
            'upvoted_by_count' => $post->upvotedBy()->count(),
            'downvoted_by_count' => $post->downvotedBy()->count(),
            'upvoted_by_user' => true,
            'downvoted_by_user' => false
        ]);
    }

    public function downvote(Request $request, Post $post)
    {
        $user = Auth::user();

        if ($user->hasUpvotedPost($post)) {
            $user->votedPost()->detach($post);
            $user->votedPost()->attach($post, ['is_upvoted' => false]);
            $post->refresh();
            return response()->json([
                'message' => 'Upvote removed and downvote added successfully.',
                'upvoted_by_count' => $post->upvotedBy()->count(),
                'downvoted_by_count' => $post->downvotedBy()->count(),
                'upvoted_by_user' => false,
                'downvoted_by_user' => true
            ]);
        }

        if ($user->hasDownvotedPost($post)) {
            $user->votedPost()->detach($post);
            $post->refresh();
            return response()->json([
                'message' => 'Downvote removed successfully.',
                'upvoted_by_count' => $post->upvotedBy()->count(),
                'downvoted_by_count' => $post->downvotedBy()->count(),
                'upvoted_by_user' => false,
                'downvoted_by_user' => false
            ]);
        }

        $user->votedPost()->attach($post, ['is_upvoted' => false]);
        $post->refresh();
        return response()->json([
            'message' => 'Post downvoted successfully.',
            'upvoted_by_count' => $post->upvotedBy()->count(),
            'downvoted_by_count' => $post->downvotedBy()->count(),
            'upvoted_by_user' => false,
            'downvoted_by_user' => true
        ]);
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

    public function showTag($tag)
    {
        // $user = Auth::user(); // Defined for consistency if needed by sorting logic later, but Auth::check() is preferred for the transform
        $posts = Post::with('user.badges', 'attachments', 'comments')
            ->whereHas('tag', function ($query) use ($tag) {
                $query->where('name', $tag);
            })
            ->orderBy('created_at', 'desc')
            ->withCount(['upvotedBy', 'downvotedBy', 'bookmarkedBy', 'comments'])
            ->paginate(10);

        $posts->getCollection()->transform(function ($post) {
            $score = ($post->upvoted_by_count * 3) +
                        ($post->downvoted_by_count * 1) -
                        ($post->comments_count * 2) +
                        ($post->bookmarks_count * 2);

            $post->weighted_score = $score;// + rand(0, 10);

            if (Auth::check()) {
                $authedUser = Auth::user();
                $post->upvoted_by_user = $authedUser->hasUpvotedPost($post);
                $post->downvoted_by_user = $authedUser->hasDownvotedPost($post);
                $post->bookmarked_by_user = $authedUser->hasBookmarkedPost($post);
            } else {
                $post->upvoted_by_user = false;
                $post->downvoted_by_user = false;
                $post->bookmarked_by_user = false;
            }
            return $post;
        });

        // Apply sorting to the collection. The existing sorting logic in showTag might need adjustment
        // if it was relying on $user variable from outside the transform for its own filtering/sorting.
        // However, the current sorting is only by weighted_score which is fine.
        // The complex sorting logic from index() method (recent user posts first) is not replicated here.
        // This method currently sorts all posts by 'weighted_score'.
        // If the same complex sorting as index() is required, it should be added here.
        // For now, just applying the sortByDesc as it was.
        $processedPosts = $posts->getCollection(); // Get collection for potential complex sort

        // Replicating the sorting from index() method for consistency, if desired.
        // If not, the simple sortByDesc('weighted_score') is fine.
        // For now, let's stick to the original sorting of showTag which was just by weighted_score.
        $finalSortedPosts = $processedPosts->sortByDesc('weighted_score');
        $posts->setCollection($finalSortedPosts->values());


        return view('home', [
            'posts' => $posts,
            // 'badges' => $badges, // $badges variable is not defined in this method currently
        ]);
    }

}
