@extends('layouts.app')

@section('title', "Users managing")

@section('content')

    <table class="table table-bordered">
        <th>NAME</th>
        <th>EMAIL</th>
        <th>EXPENSES</th>
        <th>ROLES</th>
        <th>LAST MODIFICATION</th>
        <th>ACTIONS</th>
    @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a>
            </td>

            <td>
                {{ $user->email }}
            </td>
            <td>
                <ul>
                    @foreach($user->expenses as $expense)
                        <li>
                           <b>{{$expense->amount}} $</b>  <a href="{{ route('expenses.edit', $expense->id) }}">  {{ $expense->name }}</a>
                        </li>
                    @endforeach
                </ul>
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
                {{ $user->updated_at }} <p><b>{{ $user->updated_at->diffForHumans() }}</b></p>
            </td>
            <td>
                <div class="btn btn-group">
                    <a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">Edit</a>
                    {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                    <button class="btn btn-danger" >Delete</button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    </table>

    {{$users->links()}}

    <p>
        <a class="btn btn-primary" href=" {{ route('users.create') }}">New user</a>
    </p>

@endsection