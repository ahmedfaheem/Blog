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

@endsection