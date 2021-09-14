@extends('layouts.admin.app')

@section('javascript_init')
    Posts.init({
        ckeditorUploadUrl:'{{route('posts.upload-ckeditor')}}'
    });
@endsection

@section('section-title')
    Create new post
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif()
    {!! Form::open(['route'=>'posts.store', 'files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('title','Title',['class'=>'control-label']) !!}

        {!! Form::text('title',null,['placeholder'=>'Enter title...','class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('content','Content',['class'=>'control-label']) !!}

        {!! Form::textarea('content',null,['placeholder'=>'Enter content...','class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::hidden('photo_path') !!}
    </div>

    <div class="form-group">
        <div id="dZUpload" class="dropzone" data-upload-url="{{route('posts.upload-photo')}}" data-delete-url="{{route('posts.delete-photo')}}">
            <div class="dz-message needsclick">
                <button type="button" class="dz-button">Drop an image here or click to upload.</button><br>
                <span class="note needsclick">(Supported: JPG,PNG)</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::submit('Submit post',['class'=>'btn btn-primary']) !!}

        <a class="btn btn-warning float-right" href="{{route('posts.index')}}">Back</a>
    </div>
    </div>
    {!! Form::close() !!}
@endsection
