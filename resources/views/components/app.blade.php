<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ITI Blog - @yield("title")</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-gray-800 text-white p-4">
<div class="max-w-6xl mx-auto flex justify-between">
<h1 class="text-lg font-semibold">ITI Blog</h1>
<a href="{{ route("posts.index") }}" class="text-gray-300 hover:text-white">All Posts</a>
</div>
</nav>

<div class="max-w-6xl mx-auto mt-8 bg-white shadow rounded-lg p-6">

@yield('content')


</div>

</body>
</html>