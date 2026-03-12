<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
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

        
      //  $posts = $this->posts;

      //  dd($posts); // die Dump to check the data


      $posts = Post::all();

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
       
        return view("posts.show", ["post" => $post]);
    }

    public function create()
    {
         $users = User::all();
        return view("posts.create", [
            "users" => $users,
        ]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            "title" => "required",
            "description" => "required",
            "author_id" => "required|exists:users,id"
        ]);
        Post::create($request->all());

        return to_route("posts.index");
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

        return view("posts.edit", ["post" => $post, "id"=>$id, "users"=>$users]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "author_id"  => "required|exists:users,id",

        ]);

        Post::where('id',$id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "author_id" => $request->author_id
        ]);
        
        return to_route("posts.index");
    }

    public function destroy($id)
    {
        echo "Deleting Post with ID: " . $id;
        return;
        return to_route("posts.index");
    }
}