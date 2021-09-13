<div class="overlay">
    <div class="close-overlay">
        &times;
    </div>
    <div class="overlay-box">
        <div class="tabs">
            <div data-screen="login-screen"  class="tab tab-login tab-active">
                Log In
            </div>
            <div data-screen="signup-screen" class="tab tab-sign-up tab-inactive">
                Sign Up
            </div>
        </div>

        <div class="login-screen">
            <h3>Login on My Small Blog</h3>
            <div class="icon icon-email">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="icon icon-password">
                <i class="fas fa-key"></i>
            </div>
            <hr>
            {!! Form::open(['class'=>'login-form','route'=>'user.login']) !!}
            <div class="form-group">
                {!! Form::email('email',null,['placeholder'=>'Email']) !!}
            </div>

            <div class="form-group">
                {!! Form::password('password',['placeholder'=>'Password']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Login',['class'=>'btn-submit']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="signup-screen">
            <h3>Signup to My Small Blog</h3>
                <div class="icon icon-name">
                    <i class="fa fa-user"></i>
                </div>
                <div class="icon icon-email">
                    <i class="fa fa-envelope"></i>
                </div>
                <div class="icon icon-password">
                    <i class="fas fa-key"></i>
                </div>
            <hr>
            {!! Form::open(['class'=>'signup-form','route'=>'user.store']) !!}
            <div class="form-group">
                {!! Form::text('name',null,['placeholder'=>'Name']) !!}
            </div>

            <div class="form-group">
                {!! Form::email('email',null,['placeholder'=>'Email']) !!}
            </div>

            <div class="form-group">
                {!! Form::password('password',['placeholder'=>'Password']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Signup',['class'=>'btn-submit']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
