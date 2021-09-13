<header class="blog-header py-3">
    @if(Auth::check())
        @if(Auth::user()->email_verified_at == null)
            <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                To comment, and to our admin to be able to grant you content creator role, please confirm your email by clicking the link in the email you received!
            </div>
        @endif

        @if(app('request')->input('verified'))
                <div class="modal fade bd-verification-modal-sm" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Fiók megerősítés</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Email confirmed! Now you can use the site's functions.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    @endif
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="{{route('index')}}">My Small Blog</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">

            @if(!Auth::check())
            <a class="btn btn-sm btn-outline-secondary btn-login-signup">Sign up/log in</a>
            @else
                @include('layouts.public.components.user-dropdown')
            @endif
        </div>
    </div>
</header>
<div class="nav-scroller py-1 mb-2">
&nbsp;
</div>
