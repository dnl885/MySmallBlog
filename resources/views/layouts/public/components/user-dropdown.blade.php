<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user"></i> {{Auth::user()->name}}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

        @if(Auth::user()->isAdmin() || Auth::user()->hasRole(\App\Constants\RoleConstants::ROLE_CONTENT_CREATOR))
            <a class="dropdown-item" href="{{route('admin.index')}}"><i class="fa fa-tachometer-alt"></i>Admin</a>
        @endif

        <a class="dropdown-item" href="{{route('user.logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
