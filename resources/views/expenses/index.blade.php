@extends('layouts.app')

@section('title', "Expenses managing")

@section('content')

    <table class="table table-bordered">
        <th>NAME</th>
        <th>AMOUNT</th>
        <th>LAST MODIFICATION</th>
        <th>USER</th>
        <th>ACTIONS</th>
        @foreach($expenses as $expense)
            <tr>
                <td>
                    {{ $expense->name }}
                </td>
                <td>
                    <b>{{ $expense->getPriceAttribute($expense->amount) }} $ </b>
                </td>
                <td>
                    {{ $expense->updated_at }} <p>{{ $expense->updated_at->diffForHumans() }}</p>
                </td>
                <td>
                   <b> {{ $expense->user->name }}</b>
                </td>
                <td>
                    {{--<a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">Edit</a>--}}
                    {{--{!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}--}}
                    {{--<button class="btn btn-danger" >Delete</button>--}}
                    {{--{!! Form::close() !!}--}}
                </td>
            </tr>
        @endforeach
    </table>

    {{$expenses->links()}}

    <p>
        <a class="btn btn-primary" href=" {{ route('expenses.create') }}">New expense</a>
    </p>

@endsection