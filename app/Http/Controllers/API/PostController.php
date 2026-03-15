<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('User')->get();
        return PostResource::collection($posts);
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:10',
            'description' => 'required|string|min:90',
            'author_id' => 'required|exists:users,id',
        ]);

        $post = Post::create($request->only('title', 'description', 'author_id'));

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $post = Post::find($id);

    if (!$post) {
        return response()->json([
            'message' => 'Post not found'
        ], 404);
    }

    return new PostResource($post);
}

   

}
