@extends('layouts.admin.app')

@section('section-title')
    Dashboard
@endsection

@section('content')
    <h1>Welcome {{Auth::user()->name}}!</h1>
@endsection
