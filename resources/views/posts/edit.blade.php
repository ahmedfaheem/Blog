
@extends("components.layout")
@section("title", "Update Post")

@section("content")


@include("components.postform",[
    "FormTitle" => "Update Post",
    "postAction" => route("posts.update", [$id]),
    "formMethod" => "PUT",
    "btnName" => "Update Post"
])

@endsection




