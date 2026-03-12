
@extends("components.app")
@section("title", "Create Post")

@section("content")


@include("components.postform",[
    "FormTitle" => "Create New Post",
    "postAction" => route("posts.store"),
    "btnName" => "Create Post"
])

@endsection




