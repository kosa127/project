@extends('layouts.app')

@section('title', "Expenses")

@section('content')

    <table class="table table-bordered">
        <th>NAME</th>
        <th>AMOUNT</th>
        <th>CREATED</th>
        <th>ACTIONS</th>
        @foreach($expenses as $expense)
            @if(!$expense->hasAnyUser())
                <tr>
                    <td>
                        <a href="{{ route('expenses.show', $expense->id) }}"> {{ $expense->name }}</a>
                    </td>
                    <td>
                        <b>{{ $expense->readAmount($expense->amount) }} $ </b>
                    </td>

                    <td>
                        {{ $expense->created_at }} <p>{{ $expense->created_at->diffForHumans() }}</p>
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('.expenses.show', $expense->id) }}">Details</a>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>

    {{$expenses->links()}}

    {{--<p>--}}
        {{--<a class="btn btn-primary" href=" {{ route('admin.expenses.create') }}">New expense</a>--}}
    {{--</p>--}}

@endsection