
@extends("components.layout")
@section("title", "Posts")


@section("content")

<!-- Header -->
<div class="mb-8 rounded-2xl border border-slate-200 bg-gradient-to-r from-slate-50 to-cyan-50 px-6 py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
<div>
<p class="text-xs uppercase tracking-[0.2em] text-slate-500">Blog Feed</p>
<h2 class="mt-2 text-3xl font-bold text-slate-900">All Posts</h2>
<p class="mt-2 text-sm text-slate-600">Discover the latest updates from your writers.</p>
</div>

<a href="{{ route("posts.create") }}" class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg font-medium transition">
Create Post
</a>
</div>

<!-- Blog Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
@forelse ($posts as $post)
<article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
@if(!empty($post->image))
<img src="{{ $post->image }}" alt="{{ $post->title }} image" class="h-48 w-full object-cover">
@else
<div class="h-48 w-full bg-gradient-to-br from-slate-100 to-slate-200"></div>
@endif

<div class="p-5">
<div class="flex items-center justify-between gap-2 text-xs text-slate-500 mb-3">
<span>By {{ $post->user?->name ?? 'Unknown' }}</span>
<span>{{ date('Y-m-d', strtotime($post->created_at)) }}</span>
</div>

<h3 class="text-lg font-semibold text-slate-900 line-clamp-2">{{ $post->title }}</h3>
<p class="mt-2 text-sm text-slate-600 line-clamp-3">{{ $post->description }}</p>

<div class="mt-4 text-xs text-slate-500">
Slug: <span class="font-medium text-slate-700">{{ $post->slug }}</span>
</div>

<div class="mt-5 flex items-center gap-2">
<a class="bg-teal-600 text-white px-3 py-1.5 rounded-md text-sm hover:bg-teal-700 transition"
   href="{{ route('posts.show', ['id'=>$post->id]) }}">
View
</a>

<a class="bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm hover:bg-blue-700 transition"
   href="{{ route('posts.edit', ['id'=>$post->id]) }}">
Edit
</a>

<form method="POST" action="{{ route('posts.destroy', ['id'=>$post->id]) }}">
@csrf
@method("DELETE")
@include("components.dialog", ['postId' => $post->id])
</form>
</div>
</div>
</article>
@empty
<div class="md:col-span-2 xl:col-span-3 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-10 text-center text-slate-500">
No posts found.
</div>
@endforelse
</div>

<!-- Pagination -->
<div class="mt-6 flex justify-center space-x-2">

{{ $posts->onEachSide(5)->links() }}

</div>


@endsection