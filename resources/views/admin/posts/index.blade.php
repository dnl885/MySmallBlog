@extends('layouts.admin.app')

@section('section-title')
    Manage blog posts
@endsection

@section('content')
    <a class="btn btn-add-new btn-success float-right" href="{{route('posts.create')}}"><i class="fa fa-plus"></i> Create new post</a>
    <table class="table table-striped table-responsive-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Created by</th>
            <th>Updated by</th>
            <th>Operations</th>
        </tr>
        </thead>

        <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td><a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a></td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td>{{$post->user?$post->user->name:'-'}}</td>
                <td>{{$post->editor?$post->editor->name:'-'}}</td>
                </td>
                <td><a class="btn-edit" href="{{route('posts.edit',['post'=>$post->id])}}"><i
                            class="fa fa-edit"></i></a>
                    <form class="btn-delete" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                        <button type="submit"><i class="fa fa-trash"></i></button>
                        @method('delete')
                        @csrf
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td style="text-align: center" colspan="7"><b>No posts found!</b></td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{$posts->links()}}
@endsection
