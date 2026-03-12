
@extends("components.app")
@section("title", "Posts")


@section("content")

<!-- Header -->
<div class="flex justify-between items-center mb-6">
<h2 class="text-xl font-semibold">All Posts</h2>

<a href="{{ route("posts.create") }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
Create Post
</a>
</div>

<!-- Table -->
<div class="overflow-x-auto">
<table class="min-w-full border border-gray-200">

<thead class="bg-gray-100">
<tr class="text-left text-gray-600 text-sm uppercase">
<th class="p-3">#</th>
<th class="p-3">Title</th>
<th class="p-3">Posted By</th>
<th class="p-3">Created At</th>
<th class="p-3">Actions</th>
</tr>
</thead>

<tbody class="text-gray-700">
@foreach ($posts as $post)
    
<tr class="border-t">
<td class="p-3">{{ $post->id}}</td>
<td class="p-3">{{ $post->title }}</td>
<td class="p-3">{{ $post->user?->name }}</td>
<td class="p-3">{{ date('Y-m-d', strtotime($post->created_at)) }}</td>
<td class="p-3 space-x-2">
    
<div class="flex items-center gap-2">

<a class="bg-teal-500 text-white px-3 py-1 rounded text-sm hover:bg-teal-600"
   href="{{ route('posts.show', ['id'=>$post->id]) }}">
View
</a>

<a class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600"
   href="{{ route('posts.edit', ['id'=>$post->id]) }}">
Edit
</a>

<form method="POST"
      action="{{ route('posts.destroy', ['id'=>$post->id]) }}">
    @csrf
    @method("DELETE")

    <button class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
        Delete
    </button>
</form>


</div>

</td>
</tr>

@endforeach



</tbody>

</table>
</div>

<!-- Pagination -->
<div class="mt-6 flex justify-center space-x-2">

<button class="px-3 py-1 border rounded bg-white hover:bg-gray-100">
Previous
</button>

<button class="px-3 py-1 border rounded bg-blue-500 text-white">
1
</button>

<button class="px-3 py-1 border rounded bg-white hover:bg-gray-100">
2
</button>

<button class="px-3 py-1 border rounded bg-white hover:bg-gray-100">
3
</button>

<button class="px-3 py-1 border rounded bg-white hover:bg-gray-100">
Next
</button>

</div>


@endsection