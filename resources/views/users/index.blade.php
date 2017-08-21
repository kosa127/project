@extends('layouts.app')

@section('title', "Users managing")

@section('content')

    <table class="table table-bordered">
        <th>#ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>CREATED</th>
        <th>UPDATED</th>
        <th>ROLES</th>
        <th>ACTIONS</th>
    @foreach($users as $user)
        <tr>
            <td>
                {{ $user->id }}
            </td>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {{ $user->email }}
            </td>
            <td>
                {{ $user->created_at }} <p>{{ $user->created_at->diffForHumans() }}</p>
            </td>
            <td>
                {{ $user->updated_at }} <p>{{ $user->updated_at->diffForHumans() }}</p>
            </td>
            <td>
            <ul>
                @foreach($user->roles as $role)
                    <li>
                        {{ $role->name }}
                    </li>

                @endforeach
            </ul>
            </td>
            <td>
                <a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">Edit</a>
                {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                <button class="btn btn-danger" >Delete</button>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </table>

    {{$users->links()}}

    <p>
        <a class="btn btn-primary" href=" {{ route('users.create') }}">New user</a>
    </p>

@endsection