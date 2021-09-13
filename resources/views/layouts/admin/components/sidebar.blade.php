<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.index')}}">
                    <i class="fa fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('posts.index')}}">
                    <i class="fa fa-blog"></i>
                    Manage blog posts
                </a>
            </li>
            @if(Auth::user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">
                    <i class="fa fa-user"></i>
                    Manage users
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>
