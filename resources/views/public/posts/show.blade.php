@extends('layouts.public.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <p><i class="fa fa-comment"></i> Comments ({{count($post->comments)}})</p>
    <p class="blog-post-meta">{{$post->created_at}} by {{$post->user->name}}</p>
    @if($photo = $post->photo)
        <img style="max-width:100%" src="{{$photo->path}}" alt="Photo">
    @endif

    {!! $post->content !!}

    @if(Auth::check())
    {!! Form::open(['route'=>['post.comment',['post'=>$post->id]]]) !!}
    <div class="form-group">
        {!! Form::textarea('fa-comment',null,['placeholder'=>'Type your comment here...']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit comment',['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    @else
        <h2>Log in to comment!</h2>
    @endif
    <h2>Comments ({{count($post->comments)}})</h2>

    @forelse($post->comments as $comment)

        <div class="be-comment">
            <div class="be-comment-content">
				<span class="be-comment-name">
					<span>{{$comment->user->name}}</span>
					</span>
                <span class="be-comment-time">
					<i class="fa fa-clock"></i> {{$comment->created_at}}
				</span>

                <p class="be-comment-text">
                {!! $comment->content !!}
                </p>
            </div>
        </div>

    @empty
        <h3>No comments. Be the first to comment!</h3>
    @endforelse

    <a style="margin-bottom:50px;" class="btn btn-primary" href="{{route('index')}}"><i class="fa fa-less-than"></i> Back</a>
@endsection
