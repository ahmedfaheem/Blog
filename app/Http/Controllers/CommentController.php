<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){
        $request->validate([
            "body" => "required",
        ]);



        $post->comments()->create([
            "body" => $request->body,
        ]);

        return back();
    }

    public function destroy(Comment $comment)
{
    $comment->delete();

    return back();
}
}
