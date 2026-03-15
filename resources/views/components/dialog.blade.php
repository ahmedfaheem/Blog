<button
type="button"
onclick="document.getElementById('delete-dialog-{{ $postId }}').showModal()"
class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
Delete
</button>


<dialog id="delete-dialog-{{ $postId }}"
style="position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);margin:0;width:100%;max-width:420px;border:none;padding:0"
class="rounded-xl overflow-hidden shadow-2xl backdrop:bg-black/70 backdrop:backdrop-blur-sm">

<!-- Header -->
<div class="bg-gray-900 px-6 py-5 flex items-center gap-4">



<div class="flex-1 px-1 py-2">
<h3 class="text-lg font-semibold text-gray-100 text-center">
Delete Post
</h3>

<p class="mt-2 px-1 py-2 text-sm text-gray-500 leading-6">
Are you sure you want to delete this post? This action cannot be undone.
</p>
</div>

</div>


<!-- Footer -->
<div class="bg-gray-800 px-6 py-4 flex justify-center gap-3">

<button
type="button"
onclick="document.getElementById('delete-dialog-{{ $postId }}').close()"
class="px-4 py-2 rounded-md bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium transition">
Cancel
</button>

<button
type="submit"
class="px-4 py-2 rounded-md bg-red-500 hover:bg-red-600 text-white text-sm font-semibold shadow-md transition">
Delete
</button>

</div>

</dialog>