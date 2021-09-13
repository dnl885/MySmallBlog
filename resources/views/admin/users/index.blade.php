@extends('layouts.admin.app')

@section('section-title')
    Manage users
@endsection

@section('javascript_init')
    Users.init();
@endsection

@section('content')
    <table class="table table-striped table-responsive-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Signup date</th>
            <th>Operations</th>
        </tr>
        </thead>

        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td><div data-hasrole="{{$user->hasRole(\App\Constants\RoleConstants::ROLE_CONTENT_CREATOR)}}" data-user-id="{{$user->id}}" data-url="{{route('users.grant-role')}}" title="@if(!$user->hasRole(\App\Constants\RoleConstants::ROLE_CONTENT_CREATOR))Grant @else Revoke @endif content creator role" class="btn @if(!$user->hasRole(\App\Constants\RoleConstants::ROLE_CONTENT_CREATOR))btn-warning @else btn-danger @endif btn-grant-role"><i class="fa fa-user-tag"></i></div></td>
                </td>
            </tr>
        @empty
            <tr>
                <td style="text-align: center" colspan="7"><b>No users found!</b></td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{$users->links()}}
@endsection

