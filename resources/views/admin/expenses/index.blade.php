@extends('layouts.app')

@section('title', "Expenses managing")

@section('content')

    <table class="table table-bordered">
        <th>NAME</th>
        <th>AMOUNT</th>
        <th>USER</th>
        <th>LAST MODIFICATION</th>
        <th>ACTIONS</th>
        @foreach($expenses as $expense)
            <tr>
                <td>
                   <a href="{{ route('admin.expenses.edit', $expense->id) }}"> {{ $expense->name }}</a>
                </td>
                <td>
                    <b>{{ $expense->readAmount($expense->amount) }} $ </b>
                </td>

                <td>
                    @if($expense->hasAnyUsers())
                    <a href="{{ route('admin.users.edit', $expense->user->id) }}"> <b> {{ $expense->user->name }}</b> </a>
                    @endif
                </td>
                <td>
                    {{ $expense->updated_at }} <p>{{ $expense->updated_at->diffForHumans() }}</p>
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('admin.expenses.edit', $expense->id) }}">Edit</a>
                    {!! Form::model($expense, ['route' => ['admin.expenses.destroy', $expense->id], 'method' => 'DELETE']) !!}
                    <button class="btn btn-danger" >Delete</button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {{$expenses->links()}}

    <p>
        <a class="btn btn-primary" href=" {{ route('admin.expenses.create') }}">New expense</a>
    </p>

@endsection