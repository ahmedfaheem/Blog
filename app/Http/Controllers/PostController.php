<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Jobs\PruneOldPostsJob;

class PostController extends Controller
{
    /*
    private $posts = [
        ["id" => 1, "title" => "First Post", "author" => "Ahmed","description" => "This is the first post.", "email"=> "ahmed@example.com", "create_at" => "2024-06-01"],
        ["id" => 2, "title" => "Second Post", "author" => "Ali", "description" => "This is the second post.", "email"=> "ali@example.com", "create_at" => "2024-06-02"],
        ["id" => 3, "title" => "Third Post", "author" => "Mohamed", "description" => "This is the third post.", "email"=> "mohamed@example.com", "create_at" => "2024-06-03"],
    ];
    */

    public function index()
    {

      
       //  PruneOldPostsJob::dispatch();
        //  $posts = $this->posts;

        //  dd($posts); // die Dump to check the data

        $posts = Post::latest()->paginate(20);

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        // $post = null;
        // foreach ($this->posts as $ele) {
        //     if ($ele["id"] == $id) {
        //         $post = $ele;
        //         break;
        //     }
        // }

        $post = Post::findOrFail($id);

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create', [
            'users' => $users,
        ]);
    }

    public function store(StorePostRequest $request)
    {

        // $request->validate([
        //     "title" => "required",
        //     "description" => "required",
        //     "author_id" => "required|exists:users,id"
        // ]);
        // Post::create($request->only(["title", "des", "authir_id]));

        $data = $request->validated();
        $image = $request->file('image');
        $image_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$image->getClientOriginalExtension();
        $path = $image->storeAs('postImages', $image_name, 'public');
        $data['image'] = $path;
        Post::create($data);

        return to_route('posts.index');
    }

    public function edit($id)
    {
        //     $post = null;
        //     foreach ($this->posts as $ele) {
        //         if ($ele["id"] == $id) {
        //             $post = $ele;
        //             break;
        //         }
        //     }
        $users = User::all();
        $post = Post::findOrFail($id);

        return view('posts.edit', ['post' => $post, 'id' => $id, 'users' => $users]);
    }

    public function update(StorePostRequest $request, $id)
    {
        // $request->validate([
        //     "title" => "required",
        //     "description" => "required",
        //     "author_id"  => "required|exists:users,id",

        // ],
        // [
        //      "title.min" => "Post Title must be at least 3 characters",
        // ]);
        $post = Post::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('postImages', $image_name, 'public');
            $data['image'] = $path;
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
        }

        Post::where('id', $id)->update($data);

        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->comments()->delete();
        if ($post->image) {
                Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return to_route('posts.index');
    }
}
