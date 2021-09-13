@extends('layouts.public.app')

@section('content')
    @forelse($posts as $post)
        <div class="blog-post">
            <h2 class="blog-post-title">{{$post->title}}</h2>
            <p><i class="fa fa-comment"></i> <a href="{{route('posts.show',['post'=>$post->id])}}">Comments ({{count($post->comments)}})</a></p>
            <p class="blog-post-meta">{{$post->created_at}} by {{$post->user->name}}</p>
            @if($post->photo)
                <div class="banner-wrapper">
                    <img class="img img-fluid" src="{{$post->photo->path}}" alt="{{$post->title.' banner'}}"/>
                </div>
            @endif
            {!! Str::limit($post->content,500,'...') !!}
            <p class="lead mb-0"><a href="{{route('posts.show',['post'=>$post->id])}}" class="font-weight-bold">Continue
                    reading...</a></p>
        </div>
    @empty
        <h1>No posts found. Come back later!</h1>
    @endforelse

    {{$posts->links('public.components.paginator')}}
@endsection
