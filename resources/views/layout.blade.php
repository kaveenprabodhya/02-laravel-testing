<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('title')
</head>

<body>
    {{-- <ul>
        <li><a href="/">Home</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li> --}}
    {{-- <li><a href="/posts">Posts</a></li> --}}
    {{-- <li><a href="{{ route('posts.index') }}">Posts</a></li>
        <li><a href="{{ route('posts.create') }}">Add New Post</a></li> --}}
    {{-- <li><a href="{{ route('blog-post', ['id' => 1]) }}">Blog Post 1</a></li> --}}
    {{-- </ul> --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-2 m-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My-Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                    <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </div>
            </div>
        </div>
    </nav>
    @if (session()->has('success'))
        <div class="container">
            <p style="color: green;">{{ session()->get('success') }}</p>
        </div>
    @endif
    @if (session()->has('danger'))
        <div class="container">
            <p style="color: red;">{{ session()->get('danger') }}</p>
        </div>
    @endif
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
