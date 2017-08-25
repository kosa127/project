@extends('layouts.app')

@section('title', "Expenses")

@section('content')

    <table class="table table-bordered">
        <th>NAME</th>
        <th>AMOUNT</th>
        @if(Auth::user()->hasRole('Administrator')) <th>USER</th> @endif
        <th>LAST MODIFICATION</th>
        <th>ACTIONS</th>
        @foreach($expenses as $expense)
            @if( (Auth::user()->hasRole('User') && !$expense->hasAnyUser() )|| Auth::user()->hasRole('Administrator'))
            <tr>
                <td>
                    @if(Auth::user()->hasRole('Administrator'))
                        <a href="{{ route('expenses.edit', $expense->id) }}"> {{ $expense->name }}</a>
                    @else
                        <a href="{{ route('expenses.show', $expense->id) }}"> {{ $expense->name }}</a>
                    @endif
                </td>
                <td>
                    <b>{{ $expense->readAmount($expense->amount) }} $ </b>
                </td>
            @if(Auth::user()->hasRole('Administrator'))
                <td>
                    @if($expense->hasAnyUser())
                    <a href="{{ route('users.edit', $expense->user->id) }}"> <b> {{ $expense->user->name }}</b> </a>
                    @endif
                </td>
            @endif
                <td>
                    {{ $expense->updated_at }} <p>{{ $expense->updated_at->diffForHumans() }}</p>
                </td>
                <td>
                    @if(Auth::user()->hasRole('Administrator'))
                        <a class="btn btn-info" href="{{ route('expenses.edit', $expense->id) }}">Edit</a>
                        {!! Form::model($expense, ['route' => ['expenses.destroy', $expense->id], 'method' => 'DELETE']) !!}
                        <button class="btn btn-danger" >Delete</button>
                        {!! Form::close() !!}

                    @elseif(Auth::user()->hasRole('User'))
                        <a class="btn btn-info" href="{{ route('expenses.show', $expense->id) }}">Details</a>
                        {!! Form::open(['route' => ['expenses.attachUser', $expense->id], 'method' => 'PUT']) !!}
                        <button class="btn btn-success" >Take</button>
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
            @endif
        @endforeach
    </table>

    {{$expenses->links()}}

    <p>
        <a class="btn btn-primary" href=" {{ route('expenses.create') }}">New expense</a>
    </p>

@endsection