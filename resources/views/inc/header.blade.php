<nav class="d-flex justify-content-between flex-row w-100 py-3">
    <div class="d-flex flex-row justify-content-center align-items-center gap-3 main-menu">
        <a class="logo" href="/"><h2 class="mb-0">LOGO</h2></a>
        <a href="/">Blog Posts</a>
        <a href="/categories">Categories</a>
        <a href="/writers">Writers</a>
    </div>
    @if (Auth::check())
        <div class="d-flex flex-row gap-3 main-menu">
            <a href="/new-post">New Post</a>
            <a href="/new-category">New Category</a>
            <a href="/my-posts">My Posts</a>
            <a class="text-dark bg-white" href="/logout">Logout</a>
        </div>
    @else
        <div class="d-flex flex-row gap-3 main-menu">
            <a class="text-dark bg-white" href="/login">Login</a>
            <a href="/register">Register</a>
        </div>
    @endif

</nav>
