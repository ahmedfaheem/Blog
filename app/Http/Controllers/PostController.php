<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts = [
        ["id" => 1, "title" => "First Post", "author" => "Ahmed","description" => "This is the first post.", "email"=> "ahmed@example.com", "create_at" => "2024-06-01"],
        ["id" => 2, "title" => "Second Post", "author" => "Ali", "description" => "This is the second post.", "email"=> "ali@example.com", "create_at" => "2024-06-02"],
        ["id" => 3, "title" => "Third Post", "author" => "Mohamed", "description" => "This is the third post.", "email"=> "mohamed@example.com", "create_at" => "2024-06-03"],
    ];
    public function index()
    {
        $posts = $this->posts;
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = null;
        foreach ($this->posts as $ele) {
            if ($ele["id"] == $id) {
                $post = $ele;
                break;
            }
        }
        return view("posts.show", ["post" => $post]);
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request)
    {
        echo "Storing Post: " . $request->title;
        exit;
        return to_route("posts.index");
    }

    public function edit($id)
    {
        $post = null;
        foreach ($this->posts as $ele) {
            if ($ele["id"] == $id) {
                $post = $ele;
                break;
            }
        }

        return view("posts.edit", ["post" => $post, "id"=>$id]);
    }

    public function update(Request $request, $id)
    {
        echo "Updating Post with ID: " . $id ;
        exit;
        return to_route("posts.index");
    }

    public function destroy($id)
    {
        echo "Deleting Post with ID: " . $id;
        return;
        return to_route("posts.index");
    }
}