<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        //
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
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $hashtags = collect(explode(',', $request->hashtag))
            ->map(fn ($tag) => trim(strtolower($tag)))
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
