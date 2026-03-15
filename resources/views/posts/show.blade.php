@extends("components.layout")
@section("title", "Post Page " . $post->id)

@section("content")



<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6">

<div class="mb-8 rounded-2xl border border-slate-200 bg-gradient-to-r from-slate-50 to-indigo-50 px-6 py-6">
<p class="text-xs uppercase tracking-[0.2em] text-slate-500">Post #{{ $post->id }}</p>
<h1 class="mt-2 text-3xl sm:text-4xl font-bold text-slate-900">
{{ $post->title }}
</h1>
<p class="mt-3 text-sm text-slate-600">
Published {{ $post->created_at->diffForHumans() }}
</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

<!-- Post Content -->
<article class="lg:col-span-9 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
<div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
<h2 class="text-base font-semibold text-slate-700">Post Content</h2>
</div>

<div class="p-6 space-y-6">
@if(!empty($post->image))
<img src="{{ $post->image }}" alt="{{ $post->title }} image" class="w-full max-h-[26rem] rounded-xl object-cover border border-slate-200">
@endif

<div>
<p class="text-xs uppercase tracking-[0.2em] text-slate-500">Title</p>
<p class="mt-2 text-2xl font-semibold text-slate-900">
{{ $post->title }}
</p>
</div>

<div>
<p class="text-xs uppercase tracking-[0.2em] text-slate-500">Description</p>
<p class="mt-3 text-slate-700 leading-8 whitespace-pre-line">
{{ $post->description }}
</p>
</div>
</div>
</article>

<!-- Creator Card -->
<aside class="lg:col-span-3 lg:sticky lg:top-6">
<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
<div class="border-b border-emerald-100 bg-emerald-50 px-5 py-4">
<h2 class="text-base font-semibold text-emerald-700">Post Creator</h2>
</div>

<div class="p-5 space-y-5">
<div class="flex items-center gap-3">
<div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-semibold">
{{ strtoupper(substr($post->user?->name ?? 'U', 0, 1)) }}
</div>
<div>
<p class="text-xs uppercase tracking-wide text-slate-500">Name</p>
<p class="text-sm font-medium text-slate-800">{{ $post->user?->name }}</p>
</div>
</div>

<div>
<p class="text-xs uppercase tracking-wide text-slate-500">Email</p>
<p class="mt-1 text-sm font-medium text-slate-800 break-words">{{ $post->user?->email }}</p>
</div>

<div>
<p class="text-xs uppercase tracking-wide text-slate-500">Created At</p>
<p class="mt-1 text-sm font-medium text-slate-800">{{ date("l jS \\of F Y h:i:s A", strtotime($post->created_at)) }}</p>
</div>
</div>
</div>
</aside>

</div>

<h3 class="mt-10 mb-5 text-xl font-semibold text-slate-900">
Comments
</h3>

<div class="space-y-3">

@forelse($post->comments as $comment)

<div class="rounded-xl border border-slate-200 bg-slate-50 p-4 mb-3 flex flex-col sm:flex-row sm:items-start gap-4 sm:gap-5 hover:shadow-sm transition">

<div class="flex items-start gap-3">

<!-- Avatar -->
<div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-sm font-bold">
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
class="text-red-500 hover:text-red-600 text-sm font-medium cursor-pointer">
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
<div class="mt-6 bg-white shadow-sm border border-slate-200 rounded-xl p-5">

<h3 class="text-lg font-semibold text-slate-900 mb-3">
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
class="mt-3 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
Add Comment
</button>

</form>

</div>

@endsection