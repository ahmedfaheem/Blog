<div class="max-w-3xl mx-auto mt-12 bg-white shadow-lg rounded-xl p-8">

<h2 class="text-2xl font-bold text-gray-800 mb-6">
@yield("FormTitle", $FormTitle)
</h2>

<form class="space-y-6" action="{{ $postAction }}" method="POST">
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
class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
value="{{ $post['title'] ?? '' }}"
/>
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