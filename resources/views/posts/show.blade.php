@extends("components.app")
@section("title", "Post Page " . $post->id)

@section("content")



<div class="max-w-5xl mx-auto py-12 px-6">

<h1 class="text-3xl font-bold text-gray-800 mb-8">
Post Details # {{ $post->id }}
</h1>

<div class="grid md:grid-cols-2 gap-6">

<!-- Post Info -->
<div class="bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-lg transition">

<div class="px-6 py-4 border-b bg-indigo-50 rounded-t-2xl">
<h2 class="text-lg font-semibold text-indigo-700">
Post Info
</h2>
</div>

<div class="p-6 space-y-4">

<div>
<p class="text-sm text-gray-500">Title</p>
<p class="text-lg font-semibold text-gray-800">
{{ $post->title }}
</p>
</div>

<div>
<p class="text-sm text-gray-500">Description</p>
<p class="text-gray-600 leading-relaxed">
{{ $post->description }}
</p>
</div>

</div>

</div>


<!-- Creator Info -->
<div class="bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-lg transition">

<div class="px-6 py-4 border-b bg-green-50 rounded-t-2xl">
<h2 class="text-lg font-semibold text-green-700">
Post Creator
</h2>
</div>

<div class="p-6 space-y-5">

<div class="flex items-center gap-3">
<div class="bg-green-100 text-green-600 p-2 rounded-lg">
👤
</div>
<div>
<p class="text-sm text-gray-500">Name</p>
<p class="font-medium text-gray-800">{{ $post->user?->name }}</p>
</div>
</div>

<div class="flex items-center gap-3">
<div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
✉️
</div>
<div>
<p class="text-sm text-gray-500">Email</p>
<p class="font-medium text-gray-800">{{ $post->user?->email }}</p>
</div>
</div>

<div class="flex items-center gap-3">
<div class="bg-purple-100 text-purple-600 p-2 rounded-lg">
📅
</div>
<div>
<p class="text-sm text-gray-500">Created At</p>
<p class="font-medium text-gray-800">
{{   date("l jS \of F Y h:i:s A", strtotime($post->created_at)) }}
</p>
</div>
</div>

</div>

</div>

</div>

</div>

<h3 class="mt-6 my-10 text-lg font-semibold text-gray-800" style="margin-bottom: 24px;">
Comments
</h3>

<div class="space-y-3">

@forelse($post->comments as $comment)

<div  style="margin-bottom: 24px;" class="bg-gray-50 border rounded-lg p-4 mb-3 flex flex-col sm:flex-row sm:items-start gap-4 sm:gap-5 hover:shadow-sm transition">

<div class="flex items-start gap-3">

<!-- Avatar -->
<div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-bold">
{{ strtoupper(substr($comment->body,0,1)) }}
</div>

<!-- Comment Text -->
<div>

<p class="text-gray-700 text-sm">
{{ $comment->body }}
</p>

<p class="text-xs text-gray-400 mt-1">
{{ $comment->created_at->diffForHumans() }}
</p>

</div>

</div>

<!-- Delete Button -->
<form action="{{ route('comments.destroy',$comment->id) }}" method="POST" class="mt-2 sm:mt-0 sm:ml-auto">
@csrf
@method('DELETE')

<button
class="text-red-500 hover:text-red-600 text-sm font-medium cursor-pointer ">
Delete
</button>

</form>

</div>

@empty

<p class="text-gray-400 text-sm">
No comments yet.
</p>

@endforelse

</div>

<!-- Comment Form -->
<div class="mt-6 bg-white shadow-md rounded-lg p-4">

<h3 class="text-lg font-semibold text-gray-800 mb-3">
Add Comment
</h3>

<form action="{{ route('comments.store',$post->id) }}" method="POST">
@csrf

<textarea 
name="body"
rows="3"
placeholder="Write your comment..."
class="w-full rounded-md border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3"
></textarea>

<button
class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition">
Add Comment
</button>

</form>

</div>

@endsection