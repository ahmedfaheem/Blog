<div class="max-w-3xl mx-auto mt-12 bg-white shadow-lg rounded-xl p-8">

<h2 class="text-2xl font-bold text-gray-800 mb-6">
@yield("FormTitle", $FormTitle)
</h2>

<form class="space-y-6" action="{{ $postAction }}" method="POST" enctype="multipart/form-data">
@csrf
@if(isset($formMethod) && strtoupper($formMethod) !== 'POST')
    @method($formMethod)
@endif
<!-- Title -->
<div>
<label class="block text-sm font-medium text-gray-700 mb-2">
Title
</label>
<input
type="text"
name="title"
placeholder="Enter post title"
class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 @error('title') is-invalid @enderror"
value="{{ $post['title'] ?? '' }}"
/>
@error('title')
    <p style="color:red;margin:5px 0">{{ $message }}</p>
@enderror

</div>

<!-- Image -->

<div>
<label class="block text-sm font-medium text-gray-700 mb-2">
Post Image
</label>
<input
type="file"
name="image"
accept=".jpg,.png"
class="block w-full text-sm text-slate-700 border border-slate-300 rounded-xl cursor-pointer bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-xl file:border-0 file:text-sm file:font-medium file:bg-indigo-600 file:text-white hover:file:bg-indigo-700"
/>
<p class="mt-2 text-xs text-slate-500">Allowed formats: JPG, PNG</p>
@if(isset($post) && $post->image)
    <img src="{{ $post->image }}" alt="Post Image" class="mt-4 h-52 w-full max-w-md rounded-xl border border-slate-200 object-cover shadow-sm">
@endif
@error('image')
    <p style="color:red;margin:5px 0">{{ $message }}</p>
@enderror

</div>



<!-- Description -->
<div>
<label class="block text-sm font-medium text-gray-700 mb-2">
Description
</label>

<textarea
name="description"
rows="5"
placeholder="Write your post description..."
class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
>{{ $post['description'] ?? '' }}</textarea>
@error('description')
    <p style="color:red;margin:5px 0">{{ $message }}</p>
@enderror
</div>


<!-- Post Creator -->
<div>
<label class="block text-sm font-medium text-gray-700 mb-2">
Post Creator
</label>

<select
name="author_id"
class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-indigo-500"
>
@foreach ($users as $user)
<option value="{{ $user->id }}" {{ isset($post) && $post->author_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
@endforeach

</select>
@error('author_id')
    <p style="color:red;margin:5px 0">{{ $message }}</p>
@enderror
</div>


<!-- Button -->
<div>
    <br>
<button
type="submit"
class="bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-2 rounded-lg shadow-sm transition mt-5"
>
{{ $btnName ?? "Create" }}
</button>
</div>

</form>

</div>